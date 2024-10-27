<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Challenge;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Пользователи';

    protected static ?string $modeLabel = 'Пользователи';

    protected static ?string $pluralModelLabel = 'Пользователи';

    protected static ?string $breadcrumb = 'Пользователи';

    protected static ?string $label = 'Пользователя';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->disabled()
                    ->required(),
                Forms\Components\TextInput::make('telegram_username')
                    ->label('Telegram username')
                    ->unique()
                    ->nullable(),
                Forms\Components\TextInput::make('telegram_id')
                    ->label('Telegram ID')
                    ->disabled()
                    ->nullable(),
                Forms\Components\Section::make()->schema([
                    Forms\Components\Checkbox::make('is_confirmed')->label('Проверен'),
                    Forms\Components\Checkbox::make('is_admin')->label('Администратор'),
                ])->columns(2),
                Forms\Components\TextInput::make('password')
                    ->hidden()
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'),
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('name')->label('Имя')
                        ->required(),
                    Forms\Components\TextInput::make('surname')->label('Фамилия'),
                    Forms\Components\TextInput::make('patronymic')->label('Отчество'),
                    Forms\Components\Textarea::make('about')->label('О себе')->rows(5),
                ])->columns(),
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('teams')
                            ->label('Команды, в которых состоит пользователь')
                            ->relationship('teams', 'name')
                            ->preload()
                            ->multiple(),
                        Forms\Components\Select::make('achievements')
                            ->label('Достижения пользователя')
                            ->relationship('achievements', 'name')
                            ->preload()
                            ->multiple(),
                    ])->columns(2),
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('challenges')
                            ->label('Челленджи пользователя')
                            ->relationship('challenges', 'name')
                            ->getOptionLabelFromRecordUsing(
                                function (Challenge $record) {
                                    return $record->name . ' ' . ($record->is_finished ? '(Завершён)' : '');
                                })
                            ->disabled()
                            ->preload()
                            ->multiple(),
                    ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Имя')
                    ->searchable(),
                Tables\Columns\TextColumn::make('surname')
                    ->label('Фамилия')
                    ->default('-')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Почта')
                    ->searchable(),
                CheckboxColumn::make('is_confirmed')
                    ->label('Проверен'),
                Tables\Columns\TextColumn::make('challenges_count')
                    ->counts('challenges')
                    ->badge()
                    ->color(
                        fn($record) => $record->challenges->count() > 0
                            ? 'success' : 'danger'
                    )
                    ->label('Челленджей')
                    ->sortable(),
                Tables\Columns\TextColumn::make('achievements_count')
                    ->counts('achievements')
                    ->badge()
                    ->color(
                        fn($record) => $record->achievements->count() > 0
                            ? 'success' : 'danger'
                    )
                    ->label('Достижений')
                    ->sortable()
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('is_confirmed')
                    ->checkbox()
                    ->query(fn (Builder $query): Builder => $query->whereNot('is_confirmed', true))
                    ->label('Не верифицированные'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Управление'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
