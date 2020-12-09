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
                <form action="{{ url('priority-update/'.$issuespriority->Priorityid) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Priority Name</label>
                                <input type="text" name="ISPName" class="form-control" value="{{$issuespriority->ISPName}}">
                                @if($errors->has('ISPName'))
                                <div class="alert alert-danger">
                                    <li>{{$errors->first('ISPName')}}</li>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> Priority Description</label>
                                <textarea type="text" name="Description" class="form-control">{{$issuespriority->Description}}</textarea>
                                @if($errors->has('Description'))
                                <div class="alert alert-danger">
                                    <li>{{$errors->first('Description')}}</li>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">SAVE</button>
                            <a href="/priority" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection