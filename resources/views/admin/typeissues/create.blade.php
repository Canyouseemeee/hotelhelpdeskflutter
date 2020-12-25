@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> TypeIssues-Create</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('typeissues-store') }}" method="post">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Type Name</label>
                                <input type="text" name="Typename" class="form-control" placeholder="Enter Typeissues Name">
                                @if($errors->has('Typename'))
                                <div class="alert alert-danger">
                                    <li>{{$errors->first('Typename')}}</li>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">SAVE</button>
                            <a href="/typeissues" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection