<?php

namespace Moox\BackupServerUi\Models;

use Illuminate\Database\Eloquent\Model;

class BackupServerUi extends Model
{
    protected $table = 'backup-server-ui';

    protected $fillable = [
        'name',
        'started_at',
        'finished_at',
        'failed',
    ];

    protected $casts = [
        'failed' => 'bool',
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];
}
