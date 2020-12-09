@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')

<!-- Modal -->
<div class="modal fade" id="categorylistModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Category List Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/category-list-add') }}" method="post">
                {{ csrf_field() }}

                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Category-list</label>
                        <select name="cate_id" class="form-control" require>
                            <option value="">-- Select Service Category --</option>
                            @foreach ($category as $cate_item)
                            <option value="{{ $cate_item->id }}">{{ $cate_item->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">CategoryList Name</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter Title/Category Name">
                    </div>
                    <div class="form-group">
                        <label for="">CategoryList Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">CategoryList Price</label>
                        <input type="text" name="price" class="form-control" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="">CategoryList Duration</label>
                        <input type="text" name="duration" class="form-control" placeholder="Enter Duration">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Category-List
                    <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#categorylistModal">Add</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="text-primary">
                        <th>ID</th>
                        <th>Cate</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </thead>
                    <tbody>
                        @foreach($categorylist as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->category->category_name }}</td>
                            <td>{{ $row->title }}</td>
                            <td>{{ $row->price }}</td>
                            <td>
                                <a href="{{ url('/category-list-edit/'.$row->id) }}" class="btn btn-success">EDIT</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger cagetorydeletebtn">DELETE</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection