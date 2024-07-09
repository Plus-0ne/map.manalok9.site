<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MarkerModel extends Model
{
    use HasFactory;

    protected $table = 'markers';

    protected $fillable = [
        'uuid',
        'latitude',
        'longitude',
        'title',
        'description',
        'thumbnail',
        'created_at',
        'updated_at'
    ];

    /**
     * Get all of the markerAttachments for the MarkerModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function markerAttachments(): HasMany
    {
        return $this->hasMany(MarkerAttachmentsModel::class, 'marker_uuid', 'uuid');
    }
}
