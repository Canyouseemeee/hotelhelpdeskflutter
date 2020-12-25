<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Issuespriority;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoomController extends Controller
{
    public function index(){
        $room = Room::all();
        return view('admin.room.index',compact('room'));
    }

    public function create(){
        return view('admin.room.create');
    }

    public function store(Request $request){
        // $this->validate($request, 
        // array(
        //     'ISPName' => 'required' ,
        //     'Description' => 'required'

        // ),[
        //     'ISPName.required' => 'You have enter PriorityName',
        //     'Description.required' => 'You have enter Description'
        // ]);

        $room = new Room();
        $room->NoRoom = $request->input('NoRoom');
        $room->TypeRoomid = $request->input('TypeRoomid');
        $room->Description = $request->input('Description');
        $room->save();

        Session::flash('statuscode','success');
        return redirect('/room')->with('status','Data Added for Room Successfully');
    }

    public function edit($Roomid){
        $room = Room::find($Roomid);
        return view('admin.room.edit',compact('room'));
    }

    public function update(Request $request,$Roomid){
        // $this->validate($request, 
        // array(
        //     'ISPName' => 'required' ,
        //     'Description' => 'required'

        // ),[
        //     'ISPName.required' => 'You have enter PriorityName',
        //     'Description.required' => 'You have enter Description'
        // ]);

        $room = Issuespriority::find($Roomid);
        $room->ISPName = $request->input('ISPName');
        $room->Description = $request->input('Description');
        $room->update();

        Session::flash('statuscode','success');
        return redirect('/room')->with('status','Data Update for Room Successfully');
    }

    public function delete($Roomid){
        $room = Issuespriority::findOrFail($Roomid);
        $room->delete();
        Session::flash('statuscode','error');
        return redirect('/room')->with('danger','Your room is Deleted');
    }

    public function changStatus(Request $request)
    {
        $room = Room::find($request->Roomid);
        $room->Status = $request->Status;
        $room->update();
        return response()->json(['success' => 'Status Change successfully']);
    }
}
