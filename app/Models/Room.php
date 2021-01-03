<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table ='room';
    protected $primaryKey = 'Roomid';
    protected $fillable = [
        'NoRoom','TypeRoomid','Status','Description','created_at','updated_at'
    ];
}
