<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $table ='appointments';
    protected $primaryKey = 'Appointmentsid';
    protected $fillable = [
        'Issuesid','Date','Comment','Status','Createby','Updateby','Uuid'
    ];
}
