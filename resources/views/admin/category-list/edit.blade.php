@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Category-List
                    <a href="{{url('category-list')}}" class="btn btn-scondary float-right">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('/category-list-update/'.$categorylist->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Category-list</label>
                            <select name="cate_id" class="form-control" require>
                                <option value="{{$categorylist->cate_id}}">{{$categorylist->category->category_name}}</option>
                                @foreach ($category as $cate_item)
                                <option value="{{ $cate_item->id }}">{{ $cate_item->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">CategoryList Name</label>
                            <input type="text" name="title" class="form-control" value="{{ $categorylist->title }}">
                        </div>
                        <div class="form-group">
                            <label for="">CategoryList Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $categorylist->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">CategoryList Price</label>
                            <input type="text" name="price" class="form-control" value="{{ $categorylist->price }}">
                        </div>
                        <div class="form-group">
                            <label for="">CategoryList Duration</label>
                            <input type="text" name="duration" class="form-control" value="{{ $categorylist->duration }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection