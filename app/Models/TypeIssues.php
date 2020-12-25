<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeIssues extends Model
{
    protected $table ='typeissues';
    protected $primaryKey = 'Typeissuesid';
    protected $fillable = [
        'Typename','Status','created_at','updated_at'
    ];
}
