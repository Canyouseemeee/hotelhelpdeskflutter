<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loginlog extends Model
{
    protected $table ='loginlog';
    protected $primaryKey = 'Loginid';
    protected $fillable = [
        'Deviceid','Userid','Token','Ip','expired','created_at','updated_at'
    ];
}
