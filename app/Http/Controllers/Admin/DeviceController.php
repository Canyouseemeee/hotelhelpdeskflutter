<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deviceinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DeviceController extends Controller
{
    public function index()
    {
        $deviceinfo = Deviceinfo::all();
        return view('admin.deviceinfo.index', compact('deviceinfo'));
    }

    public function create()
    {
        return view('admin.deviceinfo.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            array(
                'deviceid' => 'required',


            ),
            [
                'deviceid.required' => 'You have enter device',

            ]
        );

        $deviceinfo = new Deviceinfo();
        $deviceinfo->deviceid = $request->input('deviceid');
        $deviceinfo->save();

        Session::flash('statuscode', 'success');
        return redirect('/device')->with('status', 'Data Added for device Successfully');
    }

    public function edit($deviceinfoid)
    {
        $deviceinfo = Deviceinfo::find($deviceinfoid);
        return view('admin.deviceinfo.edit', compact('deviceinfo'));
    }

    public function update(Request $request, $deviceinfoid)
    {
        $this->validate(
            $request,
            array(
                'deviceid' => 'required',
                

            ),
            [
                'deviceid.required' => 'You have enter device',
            ]
        );

        $deviceinfo = Deviceinfo::find($deviceinfoid);
        $deviceinfo->deviceid = $request->input('deviceid');
        $deviceinfo->update();

        Session::flash('statuscode', 'success');
        return redirect('/device')->with('status', 'Data Update for device Successfully');
    }

    public function changDevice(Request $request)
    {
        $deviceinfo = Deviceinfo::find($request->deviceinfoid);
        $deviceinfo->active = $request->active;
        $deviceinfo->save();
        return response()->json(['success' => 'Status Change successfully']);
    }
}
