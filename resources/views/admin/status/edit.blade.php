@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Status-Edit</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('status-update/'.$issuesstatus->Statusid) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Status Name</label>
                                <input type="text" name="ISSName" class="form-control" value="{{$issuesstatus->ISSName}}">
                                @if($errors->has('ISSName'))
                                <div class="alert alert-danger">
                                    <li>{{$errors->first('ISSName')}}</li>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Status Description</label>
                                <textarea type="text" name="Description" class="form-control">{{$issuesstatus->Description}}</textarea>
                                @if($errors->has('Description'))
                                <div class="alert alert-danger">
                                    <li>{{$errors->first('Description')}}</li>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">SAVE</button>
                            <a href="/status" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection