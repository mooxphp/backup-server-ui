<?php

return [
    'resources' => [
        'backup-server-ui' => [
            'enabled' => true,
            'label' => 'BackupServerUi',
            'plural_label' => 'BackupServerUis',
            'navigation_group' => 'BackupServerUi Group',
            'navigation_icon' => 'heroicon-o-play',
            'navigation_sort' => 1,
            'navigation_count_badge' => true,
            'resource' => Moox\BackupServerUi\Resources\BackupServerUiResource::class,
        ],
    ],
    'pruning' => [
        'enabled' => true,
        'retention_days' => 7,
    ],
];
