<?php

namespace Moox\BackupServerUi\Resources;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Moox\BackupServerUi\Resources\BackupResource\Pages;
use Spatie\BackupServer\Models\Backup;

class BackupResource extends Resource
{
    protected static ?string $model = Backup::class;

    protected static ?string $navigationIcon = 'heroicon-s-lifebuoy';

    protected static ?string $navigationLabel = 'Backup';

    protected static ?string $pluralNavigationLabel = 'Backups';

    protected static ?string $navigationGroup = 'Backup server';

    protected static ?int $priority = 1;

    protected static ?string $recordTitleAttribute = 'source.name';

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

                    Select::make('source_id')
                        ->rules(['exists:backup_server_sources,id'])
                        ->required()
                        ->relationship('source', 'name')
                        ->searchable()
                        ->placeholder('Source')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('destination_id')
                        ->rules(['exists:backup_server_destinations,id'])
                        ->required()
                        ->relationship('destination', 'name')
                        ->searchable()
                        ->placeholder('Destination')
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

                    TextInput::make('path')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Path')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('size_in_kb')
                        ->rules(['max:255'])
                        ->nullable()
                        ->placeholder('Size In Kb')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('real_size_in_kb')
                        ->rules(['max:255'])
                        ->nullable()
                        ->placeholder('Real Size In Kb')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DatePicker::make('completed_at')
                        ->rules(['date'])
                        ->nullable()
                        ->placeholder('Completed At')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('rsync_summary')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Rsync Summary')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('rsync_time_in_seconds')
                        ->rules(['max:255'])
                        ->nullable()
                        ->placeholder('Rsync Time In Seconds')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('rsync_current_transfer_speed')
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder('Rsync Current Transfer Speed')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make(
                        'rsync_average_transfer_speed_in_MB_per_second'
                    )
                        ->rules(['max:255', 'string'])
                        ->nullable()
                        ->placeholder(
                            'Rsync Average Transfer Speed In Mb Per Second'
                        )
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
                TextColumn::make('status')
                    ->label('Status')
                    ->toggleable()
                    ->searchable()
                    ->limit(50)
                    ->badge()
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => __("backup-server-ui::translations.{$state}"))
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'failed' => 'danger',
                        'pending' => 'warning',
                        default => 'secondary',
                    }),
                TextColumn::make('source.name')
                    ->label('Source')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('destination.name')
                    ->label('Destination')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('disk_name')
                    ->label('Disk')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('path')
                    ->label('Path')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('size_in_kb')
                    ->label('Size')
                    ->toggleable()
                    ->limit(50),
                TextColumn::make('real_size_in_kb')
                    ->label('Real Size')
                    ->toggleable()
                    ->limit(50),
                TextColumn::make('completed_at')
                    ->label('Completed')
                    ->toggleable()
                    ->date(),
            ])
            ->filters([

                SelectFilter::make('source_id')
                    ->relationship('source', 'name')
                    ->indicator('Source')
                    ->multiple()
                    ->label('Source'),

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
            // BackupLogItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBackups::route('/'),
            'create' => Pages\CreateBackup::route('/create'),
            'view' => Pages\ViewBackup::route('/{record}'),
            'edit' => Pages\EditBackup::route('/{record}/edit'),
        ];
    }
}
