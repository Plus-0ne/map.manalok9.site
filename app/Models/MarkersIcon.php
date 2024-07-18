<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkersIcon extends Model
{
    use HasFactory;

    protected $table = 'markers_icon';

    protected $fillable = [
        'uuid',
        'name',
        'path',
        'type',
        'format',
        'created_at',
        'updated_at'
    ];
}
