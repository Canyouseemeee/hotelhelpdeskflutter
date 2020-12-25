@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Priority-Create</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('room-store') }}" method="post">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NoRoom</label>
                                <input type="text" name="NoRoom" class="form-control" placeholder="Enter NoRoom ">
                                @if($errors->has('NoRoom'))
                                <div class="alert alert-danger">
                                    <li>{{$errors->first('NoRoom')}}</li>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label>TypeRoom</label>
                                <select name="TypeRoomid" class="form-control">
                                    <option value="0">Deluxe Room</option>
                                    <option value="1">Suite Room</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" name="Description" class="form-control" placeholder="Enter  Description"></textarea>
                                @if($errors->has('Description'))
                                <div class="alert alert-danger">
                                    <li>{{$errors->first('Description')}}</li>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">SAVE</button>
                            <a href="/room" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection