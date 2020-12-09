@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Department-Edit</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('department-update/'.$department->Departmentid) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Department Name</label>
                                <input type="text" name="DmName" class="form-control" value="{{$department->DmName}}">
                                @if($errors->has('DmName'))
                                <div class="alert alert-danger">
                                    <li>{{$errors->first('DmName')}}</li>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Department CodeName</label>
                                <input type="text" name="DmCode" class="form-control" value="{{$department->DmCode}}">
                                @if($errors->has('DmCode'))
                                <div class="alert alert-danger">
                                    <li>{{$errors->first('DmCode')}}</li>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">SAVE</button>
                            <a href="/department" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection