<?php

namespace App\Models;

use App\Consts;
use Illuminate\Database\Eloquent\Model;

class UserDeviceRegister extends Model
{
    protected $primaryKey = 'id';

    public $fillable = [
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function userConnectionHistories()
    {
        return $this->hasMany('App\Models\UserConnectionHistory', 'device_id');
    }
}
