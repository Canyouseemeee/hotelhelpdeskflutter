<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Categorylist;
use Illuminate\Http\Request;


class CategorylistController extends Controller
{
    public function index(){
        $category = Category::all();
        $categorylist = Categorylist::all();
        return view('admin.category-list.index',compact(['category'],['categorylist']));
    }

    public function store(Request $request){
        $categorylist = new Categorylist();
        $categorylist->cate_id = $request->input('cate_id');
        $categorylist->title = $request->input('title');
        $categorylist->description = $request->input('description');
        $categorylist->price = $request->input('price');
        $categorylist->duration = $request->input('duration');
        $categorylist->save();

        return redirect()->back()->with('status','Category List is Added');
    }

    public function edit($id){
        $categorylist = Categorylist::find($id);
        $category = Category::all();
        return view('admin.category-list.edit',compact(['category'],['categorylist']));
    }

    public function update(Request $request,$id){
        $categorylist = Categorylist::find($id);
        $categorylist->cate_id = $request->input('cate_id');
        $categorylist->title = $request->input('title');
        $categorylist->description = $request->input('description');
        $categorylist->price = $request->input('price');
        $categorylist->duration = $request->input('duration');
        $categorylist->update();

        return redirect('/category-list')->with('status','Data Update for Category-List Successfully');
    }
}
