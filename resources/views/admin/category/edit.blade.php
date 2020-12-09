@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Category-Edit
                    <a href="{{ url('category') }}" class="btn btn-primary float-right">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('category-update/'.$category->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Category Name</label>
                                <input type="text" name="category_name" class="form-control" value="{{$category->category_name}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Category Description</label>
                                <textarea type="text" name="category_description" class="form-control">{{$category->category_description}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">SAVE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection