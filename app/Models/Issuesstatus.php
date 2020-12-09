<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issuesstatus extends Model
{
    protected $table ='issues_status';
    protected $primaryKey = 'Statusid';
    protected $fillable = [
        'ISSName','Description'
    ];
}
