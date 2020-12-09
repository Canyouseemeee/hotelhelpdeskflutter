<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issuestracker extends Model
{
    protected $table ='issues_tracker';
    protected $primaryKey = 'Trackerid';
    protected $fillable = [
        'TrackName','SubTrackName','Name'
    ];
}
