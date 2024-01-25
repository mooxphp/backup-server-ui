<?php

namespace Moox\BackupServerUi\Resources\BackupLogItemResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Moox\BackupServerUi\Resources\BackupLogItemResource;

class ViewBackupLogItem extends ViewRecord
{
    protected static string $resource = BackupLogItemResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make(), DeleteAction::make()];
    }
}
