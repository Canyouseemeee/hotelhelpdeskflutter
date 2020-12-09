@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> About Us - Edit Data</h4>

                <form action="{{ url('aboutus-update/'.$aboutus->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title :</label>
                            <input type="text" name="title" class="form-control" id="recipient-name" value="{{ $aboutus->title }}">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Sub-Title :</label>
                            <input type="text" name="subtitle" class="form-control" id="recipient-name" value="{{ $aboutus->subtitle }}">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Description :</label>
                            <textarea name="description" class="form-control" id="recipient-name" rows="6" cols="5">{{ $aboutus->description }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ url('abouts') }}" class="btn btn-sccondary">Back</a>
                        <button type="submit" class="btn btn-primary">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection