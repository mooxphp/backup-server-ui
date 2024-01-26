<?php

return [
    'resources' => [
        'backup' => [
            'enabled' => true,
            'label' => 'Backup',
            'plural_label' => 'Backups',
            'navigation_group' => 'Backup server',
            'navigation_icon' => 'heroicon-o-play',
            'navigation_sort' => 1,
            'navigation_count_badge' => false,
            'resource' => Moox\BackupServerUi\Resources\BackupResource::class,
        ],
        'source' => [
            'enabled' => true,
            'label' => 'Source',
            'plural_label' => 'Sources',
            'navigation_group' => 'Backup server',
            'navigation_icon' => 'heroicon-o-play',
            'navigation_sort' => 2,
            'navigation_count_badge' => false,
            'resource' => Moox\BackupServerUi\Resources\SourceResource::class,
        ],
        'destination' => [
            'enabled' => true,
            'label' => 'Destination',
            'plural_label' => 'Destinations',
            'navigation_group' => 'Backup server',
            'navigation_icon' => 'heroicon-o-play',
            'navigation_sort' => 3,
            'navigation_count_badge' => false,
            'resource' => Moox\BackupServerUi\Resources\DestinationResource::class,
        ],
        'backup-log' => [
            'enabled' => true,
            'label' => 'Backup Log',
            'plural_label' => 'Backup Logs',
            'navigation_group' => 'Backup server',
            'navigation_icon' => 'heroicon-o-play',
            'navigation_sort' => 4,
            'navigation_count_badge' => false,
            'resource' => Moox\BackupServerUi\Resources\BackupLogItemResource::class,
        ],
    ],
];
