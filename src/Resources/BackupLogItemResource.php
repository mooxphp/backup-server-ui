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
use Moox\BackupServerUi\Resources\BackupLogItemResource\Pages;
use Spatie\BackupServer\Models\BackupLogItem;

class BackupLogItemResource extends Resource
{
    protected static ?string $model = BackupLogItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'task';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 0])->schema([
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

                    Select::make('backup_id')
                        ->rules(['exists:backup_server_backups,id'])
                        ->required()
                        ->relationship('backup', 'status')
                        ->searchable()
                        ->placeholder('Backup')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('destination_id')
                        ->rules(['max:255'])
                        ->required()
                        ->placeholder('Destination Id')
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
                    ->limit(50),
                Tables\Columns\TextColumn::make('backup.status')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('destination_id')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('task')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('level')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('message')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
            ])
            ->filters([
                SelectFilter::make('source_id')
                    ->relationship('source', 'name')
                    ->indicator('Source')
                    ->multiple()
                    ->label('Source'),

                SelectFilter::make('backup_id')
                    ->relationship('backup', 'status')
                    ->indicator('Backup')
                    ->multiple()
                    ->label('Backup'),
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
            'edit' => Pages\EditBackupLogItem::route('/{record}/edit'),
        ];
    }
}
