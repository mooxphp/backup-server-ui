<?php

namespace Moox\BackupServerUi\Resources;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Moox\BackupServerUi\Models\BackupLogItem;
use Moox\BackupServerUi\Resources\BackupLogItemResource\Pages;

class BackupLogItemResource extends Resource
{
    protected static ?string $model = BackupLogItem::class;

    protected static ?string $navigationIcon = 'heroicon-s-bars-4';

    protected static ?string $navigationLabel = 'Backup Log';

    protected static ?string $pluralNavigationLabel = 'Backup Logs';

    protected static ?string $navigationGroup = 'Backup server';

    protected static ?int $priority = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('source_id')
                        ->rules(['exists:backup_server_sources,id'])
                        ->required()
                        ->relationship('source', 'name')
                        ->placeholder('Source')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('backup_id')
                        ->rules(['exists:backup_server_backups,id'])
                        ->required()
                        ->relationship('backup', 'status')
                        ->placeholder('Status')
                        ->label('Status')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Select::make('destination_id')
                        ->rules(['exists:backup_server_destinations,id'])
                        ->required()
                        ->relationship('destination', 'name')
                        ->placeholder('Destination')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('task')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Task')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('level')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Level')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('message')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Message')
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
                Tables\Columns\TextColumn::make('source.name')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('backup.status')
                    ->label('Status')
                    ->searchable()
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('destination.name')
                    ->label('Destination')
                    ->searchable()
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('task')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('level')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('message')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
            ])
            ->filters([
                SelectFilter::make('source_id')
                    ->relationship('source', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->label('Source'),

                SelectFilter::make('destination_id')
                    ->relationship('destination', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->label('Destination'),

                SelectFilter::make('task')
                    ->options([
                        'backup' => 'Backup',
                        'cleanup' => 'Cleanup',
                        'prune' => 'Prune',
                        'monitor' => 'Monitor',
                    ])
                    ->label('Task'),

                SelectFilter::make('level')
                    ->options([
                        'info' => 'Info',
                        'warning' => 'Warning',
                        'error' => 'Error',
                    ])
                    ->label('Level'),
            ])
            ->actions([ViewAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBackupLogItems::route('/'),
            'view' => Pages\ViewBackupLogItem::route('/{record}'),
        ];
    }
}
