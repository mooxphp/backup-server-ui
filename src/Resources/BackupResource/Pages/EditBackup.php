<?php

namespace Moox\BackupServerUi\Resources\BackupResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Moox\BackupServerUi\Resources\BackupResource;

class EditBackup extends EditRecord
{
    protected static string $resource = BackupResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
