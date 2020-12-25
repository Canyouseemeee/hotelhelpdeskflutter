@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Typeissues-Edit</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('typeissues-update/'.$typeissues->Typeissuesid) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Typeissues Name</label>
                                <input type="text" name="Typename" class="form-control" value="{{$typeissues->Typename}}">
                                @if($errors->has('Typename'))
                                <div class="alert alert-danger">
                                    <li>{{$errors->first('Typename')}}</li>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">SAVE</button>
                            <a href="/typeissues" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection