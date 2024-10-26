<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Команды';

    protected static ?string $modeLabel = 'Команды';

    protected static ?string $pluralModelLabel = 'Команды';

    protected static ?string $breadcrumb = 'Команды';

    protected static ?string $label = 'Команда';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Название')
                    ->required()
                    ->maxWidth('sm'),
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->rows(5),
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('users')
                            ->label('Участники')
                            ->relationship('users', 'name')
                            ->multiple(),
                        Forms\Components\Select::make('achievements')
                            ->label('Достижения')
                            ->relationship('achievements', 'name')
                            ->multiple(),
                    ])->columns(2)
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Описание')
                    ->limit(40),
                Tables\Columns\TextColumn::make('users_count')
                    ->counts('users')
                    ->badge()
                    ->color(
                        fn($record) => $record->users->count() > 0
                            ? 'success' : 'danger'
                    )
                    ->label('Участников'),
                Tables\Columns\TextColumn::make('achievements_count')
                    ->counts('achievements')
                    ->badge()
                    ->color(
                        fn($record) => $record->achievements->count() > 0
                            ? 'success' : 'danger'
                    )
                    ->label('Достижений')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}
