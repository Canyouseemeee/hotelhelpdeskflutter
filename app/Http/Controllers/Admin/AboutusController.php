<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Abouts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AboutusController extends Controller
{
    public function index()
    {
        $aboutus = Abouts::all();
        return view('admin.abouts',compact('aboutus'));
    }

    public function store(Request $request){

        $aboutus = new Abouts();

        $aboutus->title = $request->input('title');
        $aboutus->subtitle = $request->input('subtitle');
        $aboutus->description = $request->input('description');

        $aboutus->save();
        Session::flash('statuscode','success');
        return redirect('/abouts')->with('status','Data Added for About Us');
    }

    public function edit($id){
        $aboutus = Abouts::findOrFail($id);
        return view('admin.abouts.edit',compact('aboutus'));
    }

    public function update(Request $request,$id){
        $aboutus = Abouts::findOrFail($id);

        $aboutus->title = $request->input('title');
        $aboutus->subtitle = $request->input('subtitle');
        $aboutus->description = $request->input('description');
        $aboutus->update();

        Session::flash('statuscode','info');
        return redirect('/abouts')->with('status','Data Update for About Us');
    }

    public function delete($id){
        $aboutus = Abouts::findOrFail($id);
        $aboutus->delete();
        Session::flash('statuscode','error');
        return redirect('/abouts')->with('statusdanger','Your Data is Deleted');
    }
}
