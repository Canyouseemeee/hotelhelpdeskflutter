<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deviceinfo extends Model
{
    protected $table ='deviceinfo';
    protected $primaryKey = 'deviceinfoid';
    protected $fillable = [
        'deviceid','active','created_at','updated_at'
    ];
}
