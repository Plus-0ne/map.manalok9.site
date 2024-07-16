<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLogs extends Model
{
    use HasFactory;

    protected $table = 'system_logs';

    protected $fillable = [
        'uuid',
        'trigger_uuid',
        'title',
        'description',
        'type',
        'created_at',
        'updated_at'
    ];
}
