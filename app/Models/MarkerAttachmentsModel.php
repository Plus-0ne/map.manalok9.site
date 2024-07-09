<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkerAttachmentsModel extends Model
{
    use HasFactory;

    protected $table = 'markers_attachments';

    protected $fillable = [
        'uuid',
        'marker_uuid',
        'title',
        'description',
        'path',
        'format',
        'type',
        'created_at',
        'updated_at'
    ];
}
