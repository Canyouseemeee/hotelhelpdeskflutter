<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table ='department';
    protected $primaryKey = 'Departmentid';
    protected $fillable = [
        'DmName','DmCode','DmStatus'
    ];
}
