<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VersionApp extends Model
{
    protected $table ='version_app';
    protected $primaryKey = 'Appid';
    protected $fillable = [
        'AppVersion','Url','Created_by','created_at','updated_at'
    ];
}
