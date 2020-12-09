<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issuespriority extends Model
{
    protected $table ='issues_priority';
    protected $primaryKey = 'Priorityid';
    protected $fillable = [
        'ISPName','Description'
    ];
}
