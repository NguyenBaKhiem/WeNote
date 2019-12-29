<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'note_flag_id', 'title', 'description', 'image',
        'longitude', 'latitude', 'osm_id', 'osm_type', 'osm_key', 'osm_value',
        'post_code', 'country', 'city', 'district', 'street', 'house_number',
        'is_public', 'is_active', 'created_by'
    ];
}
