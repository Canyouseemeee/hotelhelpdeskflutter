<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorylist extends Model
{
    protected $table ='categorylists';
    protected $fillable = ['cate_id','title','description','price','duration'];

    public function category(){
        return $this->belongsTo(Category::class,'cate_id','id');
    }
}
