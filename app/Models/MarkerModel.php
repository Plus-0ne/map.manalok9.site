<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * Get the markerAttachment associated with the MarkerModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function markerAttachment(): HasOne
    {
        return $this->hasOne(MarkerAttachmentsModel::class, 'marker_uuid', 'uuid');
    }

    /**
     * Get the markerIcon associated with the MarkerModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function markerIcon(): HasOne
    {
        return $this->hasOne(MarkersIcon::class, 'uuid', 'thumbnail');
    }
}
