<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class CreateuserController extends Controller
{
    public function index($roomid){
        $data = Room::find($roomid);
        return view('user.createqr.create',compact('data'));
    }
}
