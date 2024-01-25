<?php

namespace Moox\BackupServerUi\Resources\BackupServerUiResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Moox\BackupServerUi\Models\BackupServerUi;
use Moox\BackupServerUi\Resources\BackupServerUiResource;
use Moox\BackupServerUi\Resources\BackupServerUiResource\Widgets\BackupServerUiWidgets;

class ListPage extends ListRecords
{
    public static string $resource = BackupServerUiResource::class;

    public function getActions(): array
    {
        return [];
    }

    public function getHeaderWidgets(): array
    {
        return [
            BackupServerUiWidgets::class,
        ];
    }

    public function getTitle(): string
    {
        return __('backup-server-ui::translations.title');
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->using(function (array $data, string $model): BackupServerUi {
                    return $model::create($data);
                }),
        ];
    }
}
