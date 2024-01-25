<?php

namespace Moox\BackupServerUi\Resources;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Moox\BackupServerUi\Resources\DestinationResource\Pages;
use Moox\BackupServerUi\Resources\DestinationResource\RelationManagers\BackupsRelationManager;
use Moox\BackupServerUi\Resources\DestinationResource\RelationManagers\SourcesRelationManager;
use Spatie\BackupServer\Models\Destination;

class DestinationResource extends Resource
{
    protected static ?string $model = Destination::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('status')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Status')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('name')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('disk_name')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Disk Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('keep_all_backups_for_days')
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder('Keep All Backups For Days')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('keep_daily_backups_for_days')
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder('Keep Daily Backups For Days')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('keep_weekly_backups_for_weeks')
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder('Keep Weekly Backups For Weeks')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('keep_monthly_backups_for_months')
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder('Keep Monthly Backups For Months')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('keep_yearly_backups_for_years')
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder('Keep Yearly Backups For Years')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make(
                        'delete_oldest_backups_when_using_more_megabytes_than'
                    )
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder(
                            'Delete Oldest Backups When Using More Megabytes Than'
                        )
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make(
                        'healthy_maximum_backup_age_in_days_per_source'
                    )
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder(
                            'Healthy Maximum Backup Age In Days Per Source'
                        )
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('healthy_maximum_storage_in_mb_per_source')
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder(
                            'Healthy Maximum Storage In Mb Per Source'
                        )
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('healthy_maximum_storage_in_mb')
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder('Healthy Maximum Storage In Mb')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('healthy_maximum_inode_usage_percentage')
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder('Healthy Maximum Inode Usage Percentage')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('name')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('disk_name')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('keep_all_backups_for_days')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('keep_daily_backups_for_days')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('keep_weekly_backups_for_weeks')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make(
                    'keep_monthly_backups_for_months'
                )
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('keep_yearly_backups_for_years')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make(
                    'delete_oldest_backups_when_using_more_megabytes_than'
                )
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make(
                    'healthy_maximum_backup_age_in_days_per_source'
                )
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make(
                    'healthy_maximum_storage_in_mb_per_source'
                )
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('healthy_maximum_storage_in_mb')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make(
                    'healthy_maximum_inode_usage_percentage'
                )
                    ->toggleable()
                    ->searchable(true, null, true),
            ])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [
            BackupsRelationManager::class,
            SourcesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDestinations::route('/'),
            'create' => Pages\CreateDestination::route('/create'),
            'view' => Pages\ViewDestination::route('/{record}'),
            'edit' => Pages\EditDestination::route('/{record}/edit'),
        ];
    }
}
