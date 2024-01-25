<?php

namespace Moox\BackupServerUi\Resources\BackupServerUiResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;
use Moox\BackupServerUi\Models\BackupServerUi;

class BackupServerUiWidgets extends BaseWidget
{
    protected function getCards(): array
    {
        $aggregationColumns = [
            DB::raw('COUNT(*) as count'),
            DB::raw('COUNT(*) as count'),
            DB::raw('COUNT(*) as count'),
        ];

        $aggregatedInfo = BackupServerUi::query()
            ->select($aggregationColumns)
            ->first();

        return [
            Stat::make(__('backup-server-ui::translations.totalone'), $aggregatedInfo->count ?? 0),
            Stat::make(__('backup-server-ui::translations.totaltwo'), $aggregatedInfo->count ?? 0),
            Stat::make(__('backup-server-ui::translations.totalthree'), $aggregatedInfo->count ?? 0),
        ];
    }
}
