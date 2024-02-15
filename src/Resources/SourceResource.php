<?php

namespace Moox\BackupServerUi\Resources;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Moox\BackupServerUi\Resources\SourceResource\Pages;
use Moox\BackupServerUi\Resources\SourceResource\RelationManagers\BackupsRelationManager;
use Spatie\BackupServer\Models\Source;

class SourceResource extends Resource
{
    protected static ?string $model = Source::class;

    protected static ?string $navigationIcon = 'heroicon-s-arrow-right-start-on-rectangle';

    protected static ?string $navigationLabel = 'Source';

    protected static ?string $pluralNavigationLabel = 'Sources';

    protected static ?string $navigationGroup = 'Backup server';

    protected static ?int $priority = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Hidden::make('status')
                        ->required()
                        ->default('active'),

                    Hidden::make('healthy')
                        ->required()
                        ->default('2'),

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

                    Select::make('destination_id')
                        ->rules(['exists:backup_server_destinations,id'])
                        ->relationship('destination', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->placeholder('Destination')
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
                IconColumn::make('healthy'),
                TextColumn::make('name')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('host')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('ssh_user')
                    ->label('SSH User')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('destination.name')
                    ->toggleable()
                    ->limit(50),
                TextColumn::make('cron_expression')
                    ->label('Cron')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
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
            // Todo: BackupLogItemsRelationManager::class,
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
