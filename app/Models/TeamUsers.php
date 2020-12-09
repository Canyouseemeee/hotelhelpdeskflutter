<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamUsers extends Model
{
    protected $table ='team_users';
    protected $primaryKey = 'Teamid';
    protected $fillable = [
        'Teamname'
    ];
}
