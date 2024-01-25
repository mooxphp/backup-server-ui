<?php

namespace Moox\BackupServerUi\Resources\BackupLogItemResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Moox\BackupServerUi\Resources\BackupLogItemResource;

class EditBackupLogItem extends EditRecord
{
    protected static string $resource = BackupLogItemResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
