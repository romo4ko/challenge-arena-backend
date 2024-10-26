<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChallengeResource\Pages;
use App\Models\Challenge;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class ChallengeResource extends Resource
{
    protected static ?string $model = Challenge::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Челленджи';

    protected static ?string $modeLabel = 'Челленджи';

    protected static ?string $pluralModelLabel = 'Челленджи';

    protected static ?string $breadcrumb = 'Челленджи';

    protected static ?string $label = 'Челлендж';

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
                Forms\Components\Section::make()->schema([
                    DateTimePicker::make('start_date')
                        ->label('Дата начала')
                        ->default(now()),
                    DateTimePicker::make('end_date')
                        ->label('Дата окончания')
                        ->nullable(),
                ])->columns(),
                Forms\Components\Textarea::make('result')
                    ->label('Результаты завершения челленджа')
                    ->rows(5),
                Forms\Components\Select::make('achievement_id')
                    ->label('Ачивка')
                    ->relationship('achievement', 'name')
                    ->searchable()
                    ->nullable(),
                FileUpload::make('image')
                    ->rules(['image'])
                    ->nullable()
                    ->image()
                    ->imageCropAspectRatio('1:1')
                    ->disk('public')
                    ->directory('achievements')
                    ->visibility('public')
                    ->maxWidth('xs')
                    ->label('Изображение')
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
                    ->limit(30),
                Tables\Columns\TextColumn::make('start_date')
                    ->dateTime('d F')
                    ->label('Дата начала'),
                Tables\Columns\TextColumn::make('end_date')
                    ->dateTime('d F')
                    ->label('Дата оконачания'),
                Tables\Columns\TextColumn::make('achievement.name')
                    ->label('Ачивка')
                    ->default('-')
                    ->url(
                        fn ($record) =>
                            ! is_null($record->achievement)
                            ? "/admin/achievements/{$record->achievement->id}/edit"
                            : null,
                        true
                    ),
                ImageColumn::make('image')
                    ->label('Изображение')
                    ->default('-'),

            ])
            ->filters([
                //
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
            'index' => Pages\ListChallenges::route('/'),
            'create' => Pages\CreateChallenge::route('/create'),
            'edit' => Pages\EditChallenge::route('/{record}/edit'),
        ];
    }
}
