<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\TypeIssues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TypeIssuesController extends Controller
{
    public function index()
    {
        $typeissues = TypeIssues::all();
        return view('admin.typeissues.index', compact('typeissues'));
    }

    public function create()
    {
        return view('admin.typeissues.create');
    }

    public function store(Request $request)
    {
        // $this->validate(
        //     $request,
        //     array(
        //         'DmName' => 'required',
        //         'DmCode' => 'required',

        //     ),
        //     [
        //         'DmName.required' => 'You have enter Department Name',
        //         'DmCode.required' => 'You have enter Department CodeName',
        //         'DmTel.required' => 'You have enter Department Tel'
        //     ]
        // );

        $typeissues = new TypeIssues();
        $typeissues->Typename = $request->input('Typename');
        // $typeissues->DmCode = $request->input('DmCode');
        $typeissues->save();

        Session::flash('statuscode', 'success');
        return redirect('/typeissues')->with('status', 'Data Added for Typeissues Successfully');
    }

    public function edit($Typeissuesid)
    {
        $typeissues = Typeissues::find($Typeissuesid);
        return view('admin.typeissues.edit', compact('typeissues'));
    }

    public function update(Request $request, $Typeissuesid)
    {
        // $this->validate(
        //     $request,
        //     array(
        //         'DmName' => 'required',
        //         'DmCode' => 'required',

        //     ),
        //     [
        //         'DmName.required' => 'You have enter Department Name',
        //         'DmCode.required' => 'You have enter Department CodeName',
        //     ]
        // );

        $typeissues = Typeissues::find($Typeissuesid);
        $typeissues->Typename = $request->input('Typename');
        $typeissues->update();

        Session::flash('statuscode', 'success');
        return redirect('/typeissues')->with('status', 'Data Update for typeissues Successfully');
    }

    public function delete($Typeissuesid)
    {
        $typeissues = Department::findOrFail($Typeissuesid);
        $typeissues->delete();
        Session::flash('statuscode', 'error');
        return redirect('/typeissues')->with('danger', 'Your typeissues is Deleted');
    }

    public function changStatus(Request $request)
    {
        $typeissues = Typeissues::find($request->Typeissuesid);
        $typeissues->Status = $request->Status;
        $typeissues->save();
        return response()->json(['success' => 'Status Change successfully']);
    }
}
