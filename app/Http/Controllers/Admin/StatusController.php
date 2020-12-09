<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Issuesstatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StatusController extends Controller
{
    public function index(){
        $issuesstatus = Issuesstatus::all();
        return view('admin.status.index',compact('issuesstatus'));
    }

    public function create(){
        return view('admin.status.create');
    }

    public function store(Request $request){
        $this->validate($request, 
        array(
            'ISSName' => 'required' ,
            'Description' => 'required'

        ),[
            'ISSName.required' => 'You have Enter StatusName',
            'Description.required' => 'You have Enter Description',
        ]);

        $issuesstatus = new Issuesstatus();
        $issuesstatus->ISSName = $request->input('ISSName');
        $issuesstatus->Description = $request->input('Description');
        $issuesstatus->save();

        Session::flash('statuscode','success');
        return redirect('/status')->with('status','Data Added for Status Successfully');
    }

    public function edit($Statusrid){
        $issuesstatus = Issuesstatus::find($Statusrid);
        return view('admin.status.edit',compact('issuesstatus'));
    }

    public function update(Request $request,$Statusrid){
        $this->validate($request, 
        array(
            'ISSName' => 'required' ,
            'Description' => 'required'

        ),[
            'ISSName.required' => 'You have Enter StatusName',
            'Description.required' => 'You have Enter Description',
        ]);

        $issuesstatus = Issuesstatus::find($Statusrid);
        $issuesstatus->ISSName = $request->input('ISSName');
        $issuesstatus->Description = $request->input('Description');
        $issuesstatus->update();

        Session::flash('statuscode','success');
        return redirect('/status')->with('status','Data Update for Status Successfully');
    }

    public function delete($Statusrid){
        $issuesstatus = Issuesstatus::findOrFail($Statusrid);
        $issuesstatus->delete();
        Session::flash('statuscode','error');
        return redirect('/status')->with('danger','Your Data is Deleted');
    }
}
