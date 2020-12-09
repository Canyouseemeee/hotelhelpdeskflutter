@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Category-Create
                    <a href="{{ url('category') }}" class="btn btn-primary float-right">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('category-store') }}" method="post">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Category Name</label>
                                <input type="text" name="category_name" class="form-control" placeholder="Enter Category Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Category Description</label>
                                <textarea type="text" name="category_description" class="form-control" placeholder="Enter Category Description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-info">SAVE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection