@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> Tracker-Create</h4>
            </div>
            <div class="card-body">
                <!-- @if($errors)
                @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    <li>{{$error}}</li>
                </div>
                @endforeach
                @endif -->
                <form action="{{ url('tracker-store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select name="TrackName" id="TrackName" class="form-control input-lg dynamic" data-dependent="SubTrackName">
                            <option value="">Select Trackname</option>
                            @foreach($trackname as $row)
                            <option value="{{$row->TrackName}}">{{$row->TrackName}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('TrackName'))
                        <div class="alert alert-danger">
                            <li>{{$errors->first('TrackName')}}</li>
                        </div>
                        @endif
                    </div>
                    <br />
                    <div class="form-group">
                        <select name="SubTrackName" id="SubTrackName" class="form-control input-lg dynamic">
                            <option value="">Select SubTrackName</option>
                        </select>
                        @if($errors->has('SubTrackName'))
                        <div class="alert alert-danger">
                            <li>{{$errors->first('SubTrackName')}}</li>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" id="Name" name="Name" class="form-control" placeholder="Enter">
                                @if($errors->has('Name'))
                                <div class="alert alert-danger">
                                    <li>{{$errors->first('Name')}}</li>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">SAVE</button>
                            <a href="/tracker" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        $('.dynamic').change(function() {
            var TrackName = $("#TrackName option:selected").val();
            if (TrackName != '') {
                var select = $(this).attr("id");
                var dependent = $(this).data('dependent');

                var TrackName = $("#TrackName option:selected").val();
                var SubTrackName = $("#SubTrackName option:selected").val();
                var Name = $("#Name option:selected").val();
                console.log(select);
                console.log(TrackName);
                console.log(SubTrackName);
                console.log(Name);
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('dynamiccontroller.fetch') }}",
                    method: "GET",
                    data: {
                        select: select,
                        TrackName: TrackName,
                        SubTrackName: SubTrackName,
                        Name: Name,
                        _token: _token,
                        dependent: dependent
                    },
                    success: function(result) {
                        $('#' + dependent).html(result);
                        $('#SubTrackName').prop('disabled', false);

                    }
                });
            }
            if (TrackName == '') {
                $('#SubTrackName').empty().append('<option>Select SubTrackName</option>');;
                $('#Name').html('<option value="">Select Name</option>');
                $('#tracker_id').val('');
                $('#Name').prop('disabled', false);
            }
            if (SubTrackName != '') {
                $('#Name').html('<option value="">Select Name</option>');
                $('#tracker_id').val('');
                $('#Name').prop('disabled', false);

            }
            // if (Name == '') {
            //     $('#SubTrackName').html('<option value="">Select Name</option>');
            //     $('#tracker_id').val('');
            // }
            if (SubTrackName == 'Other') {
                $('#Name').prop('disabled', 'disabled');
                $('#Name').val('ไม่สามารถเพิ่ม/แก้ไขข้อมูลได้');
                document.getElementById("Name").readOnly = true;
            }
            if (SubTrackName != 'Other') {
                document.getElementById("Name").readOnly = false;
                $('#Name').val('');
                $('#Name').prop('disabled', false);
            }
        });

    });
</script>
@endsection