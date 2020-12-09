@extends('layouts.master')

@section('title')
Register Edit
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit User') }}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="/role-register-update/{{ $users->id }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="{{$users->name}}" name="name">
                                </div>
                                <div class="form-group">
                                    <label>Give Role</label>
                                    <select name="usertype" class="form-control">
                                        <option value="admin" @if ($users->usertype === 'admin')
                                            selected
                                            @endif>Admin</option>
                                        <option value="user" @if ($users->usertype === 'user')
                                            selected
                                            @endif>User</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>LoginType</label>
                                    <select name="logintype" class="form-control">
                                        <option value="1" @if ($users->logintype === 1)
                                            selected
                                            @endif>AD</option>
                                        <option value="0" @if ($users->logintype === 0)
                                            selected
                                            @endif>DB</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Team</label>
                                        <select name="teamid" class="form-control">
                                            <option value="1" @if ($users->teamid === 1)
                                                selected
                                                @endif>HW</option>
                                            <option value="2" @if ($users->teamid === 2)
                                                selected
                                                @endif>SW</option>
                                            <option value="3" @if ($users->teamid === 3)
                                                selected
                                                @endif>ADMIN</option>
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" value="{{$users->username}}" name="username">
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Image Profile (ถ้ามีรูปภาพอยู่แล้วไม่ต้องเพิ่มรูป)') }}</label>
                                    <div class="col-md-6">
                                        <input type="file" id="image" name="image">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="/role-register" class="btn btn-danger">Cancel</a>
                                <a href="/role-reset/{{$users->id}}" class="btn btn-warning">Reset Password</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection