<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssuesLogs extends Model
{
    protected $table ='issues_logs';
    protected $primaryKey = 'logs_id';
    protected $fillable = [
        'Issuesid','Createby','Action','created_at','updated_at'
    ];
}