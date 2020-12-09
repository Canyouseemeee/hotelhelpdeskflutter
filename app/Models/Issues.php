<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    protected $table ='issues';
    protected $primaryKey = 'Issuesid';
    protected $fillable = [
        'Trackerid','Priorityid','Statusid','Departmentid','Createby','Updatedby','Closedby','Assignment','Subject','Tel','Comname','Informer','Description'
        ,'Date_In','Uuid','Image','created_at','updated_at'
    ];

    public function tracker(){
        return $this->belongsTo(Issuestracker::class,'Trackerid','Trackerid');
    }

    public function status(){
        return $this->belongsTo(Issuesstatus::class,'Statusid','Statusid');
    }

    public function priority(){
        return $this->belongsTo(Issuespriority::class,'Priorityid','Priorityid');
    }

    public function department(){
        return $this->belongsTo(Department::class,'Departmentid','Departmentid');
    }
}
