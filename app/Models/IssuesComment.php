<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssuesComment extends Model
{
    protected $table ='issues_comment';
    protected $primaryKey = 'Commentid';
    protected $fillable = [
        'Issuesid','Status','Type','Comment','Image','Uuid','Createby','created_at','updated_at'
    ];
}
