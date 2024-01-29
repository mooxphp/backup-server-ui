<?php

namespace Moox\BackupServerUi\Resources;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Moox\BackupServerUi\Resources\SourceResource\Pages;
use Moox\BackupServerUi\Resources\SourceResource\RelationManagers\BackupsRelationManager;
use Spatie\BackupServer\Models\Source;

class SourceResource extends Resource
{
    protected static ?string $model = Source::class;

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

                    TextInput::make('healthy')
                        ->rules(['max:255'])
                        ->required()
                        ->placeholder('Healthy')
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

                    TextInput::make('host')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Host')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('ssh_user')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Ssh User')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('ssh_port')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Ssh Port')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('ssh_private_key_file')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Ssh Private Key File')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('cron_expression')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Cron Expression')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    KeyValue::make('pre_backup_commands')
                        ->nullable()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    KeyValue::make('post_backup_commands')
                        ->nullable()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    KeyValue::make('includes')
                        ->nullable()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    KeyValue::make('excludes')
                        ->nullable()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('destination_id')
                        ->rules(['exists:backup_server_destinations,id'])
                        ->nullable()
                        ->relationship('destination', 'name')
                        ->searchable()
                        ->placeholder('Destination')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('cleanup_strategy_class')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Cleanup Strategy Class')
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

                    TextInput::make('healthy_maximum_backup_age_in_days')
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder('Healthy Maximum Backup Age In Days')
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
                Tables\Columns\TextColumn::make('healthy')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('name')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('host')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('ssh_user')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('ssh_port')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('ssh_private_key_file')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('cron_expression')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('destination.name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('cleanup_strategy_class')
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
                    'healthy_maximum_backup_age_in_days'
                )
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('healthy_maximum_storage_in_mb')
                    ->toggleable()
                    ->searchable(true, null, true),
            ])
            ->filters([
                SelectFilter::make('destination_id')
                    ->relationship('destination', 'name')
                    ->indicator('Destination')
                    ->multiple()
                    ->label('Destination'),
            ])
            ->actions([ViewAction::make(), EditAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [
            BackupsRelationManager::class,
            // BackupLogItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSources::route('/'),
            'create' => Pages\CreateSource::route('/create'),
            'view' => Pages\ViewSource::route('/{record}'),
            'edit' => Pages\EditSource::route('/{record}/edit'),
        ];
    }
}
