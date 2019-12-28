<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserConnectionHistory extends Model
{
    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = [

    ];

    public function device()
    {
        return $this->belongsTo('App\Models\UserDeviceRegister');
    }
}