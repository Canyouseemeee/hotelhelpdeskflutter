<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abouts extends Model
{
    protected $table ='abouts';
    protected $fillable = ['title','subtitle','description'];
}
