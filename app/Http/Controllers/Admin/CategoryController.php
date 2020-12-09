<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return view('admin.category.index',compact('category'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
        $category = new Category();
        $category->category_name = $request->input('category_name');
        $category->category_description = $request->input('category_description');
        $category->save();

        Session::flash('statuscode','success');
        return redirect('/category')->with('status','Data Added for Category Successfully');
    }

    public function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request,$id){
        $category = Category::find($id);
        $category->category_name = $request->input('category_name');
        $category->category_description = $request->input('category_description');
        $category->update();

        Session::flash('statuscode','success');
        return redirect('/category')->with('status','Data Update for Category Successfully');
    }

    public function delete($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['status'=>'Category Delete Sucessfully']);
    }
}
