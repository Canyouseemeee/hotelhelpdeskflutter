<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Issuestracker;
use App\Models\Tracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TrackerController extends Controller
{
    public function index()
    {
        $trackname = Issuestracker::all();
        // ->get();
        return view('admin.tracker.index', compact('trackname'));
    }

    public function create()
    {
        $trackname = DB::table('issues_tracker')
            ->groupBy('TrackName')
            ->get();
        return view('admin.tracker.create', compact('trackname'));
    }

    public function store(Request $request)
    {
        $this->validate($request, 
        array(
            'TrackName' => 'required|max:2' ,
            'SubTrackName' => 'required|max:20',
            'Name' => 'required|max:20'

        ),[
            'TrackName.required' => 'You have select TrackName',
            'SubTrackName.required' => 'You have select SubTrackName',
            'Name.required' => 'You have enter Name'
        ]);

        $dynamic = new Issuestracker();
        $dynamic->TrackName = $request->input('TrackName');
        $dynamic->SubTrackName = $request->input('SubTrackName');
        $dynamic->Name = $request->input('Name');
        $dynamic->save();

        Session::flash('statuscode', 'success');
        return redirect('/tracker')->with('status', 'Data Added for Tracker Successfully');
    }

    public function edit($Trackerid)
    {
        $trackname = DB::table('issues_tracker')
            ->groupBy('TrackName')
            ->get();
        $tracker = Issuestracker::find($Trackerid);
        return view('admin.tracker.edit', compact([['tracker'], ['trackname']]));
    }

    public function update(Request $request, $Trackerid)
    {

        $this->validate($request, 
        array(
            'TrackName' => 'required' ,
            'SubTrackName' => 'required|',
            'Name' => 'required'

        ),[
            'TrackName.required' => 'You have select TrackName',
            'SubTrackName.required' => 'You have select SubTrackName',
            'Name.required' => 'You have enter Name'
        ]);

        $tracker = Issuestracker::find($Trackerid);
        $tracker->TrackName = $request->input('TrackName');
        $tracker->SubTrackName = $request->input('SubTrackName');
        $tracker->Name = $request->input('Name');
        $tracker->update();

        Session::flash('statuscode', 'success');
        return redirect('/tracker')->with('status', 'Data Update for Tracker Successfully');
    }

    public function delete($Trackerid)
    {
        $tracker = Issuestracker::findOrFail($Trackerid);
        $tracker->delete();
        Session::flash('statuscode', 'error');
        return redirect('/tracker')->with('danger', 'Your Data is Deleted');
    }

    public function fetch(Request $request)
    {
        $tracker = Issuestracker::all();
        $select = $request->get('select');
        $TrackName = $request->get('TrackName');
        $SubTrackName = $request->get('SubTrackName');
        $Name = $request->get('Name');
        $dependent = $request->get('dependent');
        // echo $select . "," . $value . "," . $dependent;
        $data = DB::table('tracker')
            ->where($select, $TrackName)
            ->groupBy($dependent)
            ->get();
        // $data2 = DB::table('tracker')
        //     ->where([['TrackName', $TrackName], [$select, $SubTrackName]])
        //     ->groupBy($dependent)
        //     ->get();
        $output = '<option value="" disabled="true" selected="true">Select '
            . ucfirst($dependent) . '</option>';

        //echo "DATA:".print_r($data);   

        foreach ($data as $row2) {
            $output = $output . '<option value="' . $row2->$dependent . '" > 
                ' . $row2->$dependent . ' </option>';
        }
        // foreach ($data2 as $row3) {
        //     $output = $output . '<option value="' . $row3->$dependent . '"> 
        //         ' . $row3->$dependent . ' </option>';
        // }
        echo $output;
        // echo $data;
        // return response()->json($data);
    }
}
