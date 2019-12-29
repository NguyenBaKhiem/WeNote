<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteFlag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'style'
    ];
}
