@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Priority-Edit</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('room-update/'.$room->Roomid) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NoRoom</label>
                                <input type="text" name="NoRoom" class="form-control" value="{{$room->NoRoom}}">
                                @if($errors->has('NoRoom'))
                                <div class="alert alert-danger">
                                    <li>{{$errors->first('NoRoom')}}</li>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>TypeRoom</label>
                                <select name="TypeRoomid" class="form-control">
                                    <option value="0" @if ($room->TypeRoomid === 0)
                                        selected
                                        @endif>Deluxe Room</option>
                                    <option value="1" @if ($room->TypeRoomid === 1)
                                        selected
                                        @endif>Suite Room</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" name="Description" class="form-control">{{$room->Description}}</textarea>
                                @if($errors->has('Description'))
                                <div class="alert alert-danger">
                                    <li>{{$errors->first('Description')}}</li>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">SAVE</button>
                            <a href="/room" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection