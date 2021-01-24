@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')

<?php
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate));
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $newDate = date('Y-m-d\TH:i', strtotime($strDate));
    return "$newDate";
    // return "$strDay-$strMonth-$strYear\T$strHour:$strMinute";
}
?>

<button type="button" class="btn btn-outline-warning btn_showIssues active">Issues Create</button>
<button type="button" class="btn btn-outline-primary btn_showComments">Comments</button>
<!-- <button type="button" class="btn btn-outline-danger btn_showAppointments">Appointments</button> -->

<div class="row subissues">
    <div class="col-md-12">
        <div class="card card-nav-tabs card-plain">
            <div class="card-header ">
                <h4 class="card-title"> Issues-Create</h4>
            </div>
            <div class="card-body ">
                @if($errors)
                @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    <li>{{$error}}</li>
                </div>
                @endforeach
                @endif
                <form action="{{ url('issues-store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-row">

                        <!-- <div class="col-md-3">
                            <label>Tracker</label>
                            <select name="TrackName" id="TrackName" class="form-control input-lg dynamic" data-dependent="SubTrackName">
                                <option value="">Select Trackname</option>
                                @foreach($tracker as $row)
                                <option value="{{$row->TrackName}}">{{$row->TrackName}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>SubTracker</label>
                            <select name="SubTrackName" id="SubTrackName" class="form-control input-lg dynamic findidother" data-dependent="Name" disabled>
                                <option value="">Select SubTrackName</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Name</label>
                            <select name="Name" id="Name" class="form-control input-lg Name " disabled>
                                <option value="">Select Name</option>
                            </select>
                        </div> -->

                        <!-- <div class="form-group">
                            <input type="hidden" class="tracker_id" id="Trackerid" name="Trackerid">
                        </div> -->


                        <!-- <div class="col-md-3">
                            <label>Priority</label>
                            <select name="Priorityid" class="form-control create" require>
                                @foreach($issuespriority as $row2)
                                <option value="{{$row2->Priorityid}}" @if (old("Priorityid")==$row2->Priorityid) selected @endif>{{$row2->ISPName}}</option>
                                @endforeach
                            </select>
                        </div> -->

                        <!-- <div class="form-group col-md-3">
                            <label>NoRoom</label>
                            <input name="NoRoom" class="form-control" value="" placeholder="Number Room">
                        </div> -->

                        <div class="form-group col-md-3">
                            <label>NoRoom</label>
                            <p>
                                <select id="Roomid" name="Roomid" class="form-control-lg create col-md-12" require>
                                    @foreach($room as $row3)
                                    <option value="{{$row3->Roomid}}" @if (old("Roomid")==$row3->Roomid) selected @endif>{{$row3->NoRoom}}</option>
                                    @endforeach
                                </select></p>
                        </div>

                        <div class="col-md-3">
                            <label>Status</label>
                            <select name="Statusid" class="form-control create" require>
                                <option value="1" @if (old("Statusid")==1) selected @endif>New</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label>TypeIssues</label>
                            <p>
                                <select id="Typeissuesid" name="Typeissuesid" class="form-control-lg create col-md-12" require>
                                    @foreach($typeissues as $row4)
                                    <option value="{{$row4->Typeissuesid}}" @if (old("Typeissuesid")==$row4->Typeissuesid) selected @endif>{{$row4->Typename}}</option>
                                    @endforeach
                                </select></p>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Createby</label>
                            <input name="Createby" class="form-control" readonly="readonly" value="{{Auth::user()->name}}" placeholder="{{Auth::user()->name}}">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Date</label>
                            <input name="Date_In" class="form-control" readonly="readonly" value="{{now()->toDateString()}}" placeholder="{{now()->toDateString()}}">
                        </div>

                        <div class="form-group col-md-3">
                            <label>Assignment</label>
                            <select name="Assignment" class="form-control create" require>
                                <option value="">Select Assignment</option>
                                @foreach($user as $row5)
                                    @foreach($usertest as $rowtest)
                                    @if ($row5->id === $rowtest->id)
                                    @if ($rowtest->Statusid === null)
                                        <option value="{{$row5->id}}" @if (old("Assignment")==$row5->id) selected @endif>{{$row5->name}} - 0</option>
                                    @else
                                        <option value="{{$row5->id}}" @if (old("Assignment")==$row5->id) selected @endif>{{$row5->name}} - {{$rowtest->count}}</option>
                                    @endif
                                    @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="Subject" class="form-control" placeholder="Enter Subject" value="{{old('Subject')}}">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="Description" class="form-control" placeholder="Enter Description">{{old('Description')}}</textarea>
                    </div>

                    <div class="form-group col-md-3">
                        <!-- <label>Uuid</label> -->
                        <input name="temp" class="form-control" placeholder="{{$temp}}" value="{{$temp}}" hidden>
                    </div>

                    <!-- <div>
                        <input type="file" id="Image" name="Image">
                    </div> -->
                    <br>
                    <input type="submit" value="Save" class="btn btn-primary ">
                    <a href="/issues" class="btn btn-danger">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
&nbsp;

<div class="row panelsub_all subcomment">
    <style>
        .elevation-2 {
            box-shadow: 0 3px 6px rgba(0, 0, 0, .16), 0 3px 6px rgba(0, 0, 0, .23) !important;
        }

        .img-circle {
            border-radius: 50%;
        }

        .username {
            font-size: 16px;
            font-weight: 600;
            margin-top: -1px;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;

            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .user-block .description {
            color: #6c757d;
            font-size: 13px;
            margin-top: -3px;
        }

        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
            background-color: #fff;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        .card-widget {
            border: 0;
            position: relative;
            border-top: 0;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
    </style>
    <div class="col-md-12">
        <!-- Box Comment -->
        <div class="card-header">
            <h4 class="card-title"> Comments
                <!-- <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#issuescommentsModal">Comments Add</a> -->
            </h4>
            <!-- <form id="addformcomment" enctype="multipart/form-data"> -->
            <form id="addformcomment">
                {{ csrf_field() }}
                <div class="body">
                    <div class="form-group">
                        <label for="">Comment</label>
                        <textarea id="CComment" name="CComment" class="form-control" rows="1" placeholder="Enter Comment"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Image</label><br>
                        <input type="file" id="image" name="image">
                    </div>

                    <div class="form-group">
                        <!-- <label for="">Createby</label> -->
                        <input type="text" id="CCreateby" name="CCreateby" class="form-control" value="{{Auth::user()->name}}" placeholder="{{Auth::user()->name}}" hidden>
                    </div>

                    <div class="form-group">
                        <!-- <label for="">Uuid</label> -->
                        <input id="Ctemp" name="Ctemp" class="form-control" placeholder="{{$temp}}" value="{{$temp}}" hidden>
                    </div>

                    <div id="resultcomment">
                    </div>

                    <div id="resultcomment2">
                    </div>
                </div>
                <div class="footer">
                    <button type="button" id="savecomment" class="btn btn-primary right">Post</button>
                    <br>
                    <div id="countcomment">
                        @if(!is_null($countcomment))
                        <br>
                        <h4>Comments ({{$countcomment}})</h4>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <br>
        </div>
        <div style="overflow-y: auto;; height: 500px;">
            <div class="card card-widget"  id="cardcomment">
                @if(!is_null($comment))
                @foreach($comment as $row)
                <div class="card-header">
                    <div class="user-block">
                        @foreach($usercomment as $userc)
                        @if(!is_null($userc->image))
                        <img class="img-circle" src="{{ url('storage/'.$userc->image) }}" alt="Image" width="50" height="50">
                        @else
                        <span class="username">ไม่มีรูปภาพ</span>
                        @endif
                        @endforeach
                        <span class="username">{{$row->Createby}} : </span>
                        <span class="description">{{$row->created_at}}</span>
                        @if($row->Type === 1)
                        <span class="description">: App</span>
                        @elseif($row->Type === 0)
                        <span class="description">: Web</span>
                        @endif
                        @if($row->Status === 1)
                        <span class="description" style="color: green;">#Active</span>
                        @elseif($row->Status === 0)
                        <span class="description" style="color: red;">#UnActive</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @if($row->Status === 1)
                    <button id="Unsend1" type="button" OnClick="JavaScript:fncConfirm1({{$row->Commentid}});" class="btn btn-default btn-sm float-right"><i class="fas fa-comment-slash"></i></i> Unsend</button>
                    @endif
                    @if($row->Image != null)
                    <img class="img-fluid pad center" src="{{ url('storage/'.$row->Image) }}" style="align-items: center;" width="555" height="550" alt="Photo">
                    @else
                    <p style="padding-top: 20px;">ไม่มีรูปภาพ</p>
                    @endif
                    <p style="padding-top: 20px;">{{$row->Comment}}</p>
                    <span class="float-right text-muted">updated {{$row->updated_at}} By {{$row->Updateby}}</span>
                </div>
                <div class="card-footer">
                    <br>
                </div>
                @endforeach
            </div>
            @else
            <div class="card card-widget" id="cardcomment">
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

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
            if (SubTrackName == 'Other') {
                $('#Name').prop('disabled', 'disabled');
            }
            if (SubTrackName != 'Other') {
                $('#Name').prop('disabled', false);
            }
        });



        $(document).on('change', '.Name', function() {
            var SubTrackName = $("#SubTrackName option:selected").val();
            if (SubTrackName != 'Other') {
                var tracker_id = $(this).val();
                var TrackName = $("#TrackName option:selected").val();
                var SubTrackName = $("#SubTrackName option:selected").val();
                var Name = $("#Name option:selected").val();
                var a = $(this).parent();
                // console.log(tracker_id);

                var op = "";
                $.ajax({
                    type: 'get',
                    url: '{!!URL::to("findid")!!}',
                    data: {
                        // 'Name': tracker_id,
                        TrackName: TrackName,
                        SubTrackName: SubTrackName,
                        Name: Name,
                    },
                    dataType: 'json', //return data will be json
                    success: function(data) {
                        // console.log("Trackerid","3");
                        // console.log(len(data));
                        console.log(data);

                        // here price is coloumn name in products table data.coln name
                        $('#Trackerid').val(data);
                        // a.find('.tracker_id').val(data.Name);
                        // console.log(data = JSON.parse(data));



                    },
                    error: function() {

                    }
                });
            }

        });

        $(document).on('change', '.findidother', function() {

            var tracker_id = $(this).val();
            var TrackName = $("#TrackName option:selected").val();
            var SubTrackName = $("#SubTrackName option:selected").val();
            var Name = $("#Name option:selected").val();
            var a = $(this).parent();
            // console.log(tracker_id);

            var op = "";
            $.ajax({
                type: 'get',
                url: '{!!URL::to("findidother")!!}',
                data: {
                    TrackName: TrackName,
                    SubTrackName: SubTrackName,
                    Name: Name,
                },
                dataType: 'json', //return data will be json
                success: function(data) {
                    console.log(data);

                    // here price is coloumn name in products table data.coln name
                    $('#Trackerid').val(data);

                },
                error: function() {

                }
            });


        });

    });
</script>

<script>
    $('#Typeissuesid').select2({
        placeholder: " Enter TypeIssues",
        minimumInputLength: 1,
        delay: 250,
        allowClear: true,
    });

    $('#Roomid').select2({
        placeholder: " Enter NoRoom",
        minimumInputLength: 1,
        delay: 250,
        allowClear: true,
    });
</script>

<script>
    function fncConfirm1(commentid) {
        //   var txt;
        $('#resultcomment').empty();
        $('#resultcomment2').empty();

        if (confirm("ท่านต้องการยกเลิกข้อความนี้ใช่หรือไม่ ?")) {
            // txt = "You pressed OK!"+cid;
            $.ajax({
                type: "POST",
                data: {
                    commentid: commentid
                },
                url: "/api/commentliststatus",
                success: function(response) {
                    console.log(response);
                    // $('#SubmitUnsend').attr('disabled', 'disabled');
                    $("#resultcomment2").html('<div class="alert alert-danger" role="alert" id="result">Comments Unsend Sucess</div>');
                    $('#cardcomment').empty();
                    $('#countcomment').empty();
                    var temp = $('#Ctemp').val();
                    $.ajax({
                        type: "POST",
                        data: {
                            temp: temp
                        },
                        url: "/api/commentlist",
                        success: function(response) {
                            $('#savecomment').removeAttr('disabled');
                            $('#CComment').removeAttr('readonly').val("");
                            // $("#resultcomment").empty();
                            $('#image').val("");
                            var len = response.length;
                            if (len > 0) {
                                var irow = response.length;
                                var i = 0;
                                var rown = 1;
                                var html2 = '<br><h4 class="card-title">';
                                html2 += 'Comments(' + response.length + ')';
                                html2 += '</h4>';
                                for (i = 0; i < irow; i++) {
                                    var html = '<div class="card-header">';
                                    html += '<div class="user-block">';
                                    if (response[i].image != null) {
                                        // html += '<td><img src="http://10.57.34.148:8000/storage/' + response[i].Image + '" alt="image" width="80" height="80"></td>';
                                        html += '<img class="img-circle" src="/storage/' + response[i].image + '" alt="Image" width="50" height="50"> &nbsp;'
                                    }
                                    html += '<span class="username">' + response[i].Createby + ' : </span>'
                                    html += '<span class="description">' + response[i].created_at + ' </span>'
                                    if (response[i].Type == 1) {
                                        html += '<span class="description">: App </span>';
                                    }
                                    if (response[i].Type == 0) {
                                        html += '<span class="description">: Web </span>';
                                    }
                                    if (response[i].Status === 1) {
                                        html += '<span class="description" style="color: green;">#Active</span>';
                                    }
                                    if (response[i].Status === 0) {
                                        html += '<span class="description" style="color: red;">#UnActive</span>';
                                    }

                                    html += '</div>'
                                    html += '</div>'
                                    html += '<div class="card-body">'
                                    if (response[i].Status === 1) {
                                        html += '<button id="Unsend1" type="button" OnClick="JavaScript:fncConfirm1(' + response[i].Commentid + ');"  class="btn btn-default btn-sm float-right"><i class="fas fa-comment-slash"></i></i> Unsend</button>'
                                    }
                                    if (response[i].Image != null) {
                                        html += '<img class="img-fluid pad center" src="/storage/' + response[i].Image + '" style="align-items: center;" width="555" height="550" alt="Photo">'
                                    } else {
                                        html += '<p style="padding-top: 20px;">ไม่มีรูปภาพ</p>'
                                    }
                                    html += '<p style="padding-top: 20px;">' + response[i].Comment + '</p>'
                                    html += '<span class="float-right text-muted">updated ' + response[i].updated_at + ' By ' + response[i].Updateby + '</span>'
                                    html += '</div>'
                                    html += '<div class="card-footer">'
                                    html += '<bt>'
                                    html += '</div>'

                                    $('#cardcomment').append(html);
                                }
                                $('#countcomment').append(html2);
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                },
                error: function(error) {
                    console.log(error);
                    // $('#SubmitUnsend').attr('disabled', 'disabled');
                    // alert("Data Saved");
                    $("#resultcomment2").html('<div class="alert alert-danger" role="alert" id="result">Comments Unsend Sucess</div>');
                }
            });
        } else {
            // txt = "You pressed Cancel!";
        }
        //   console.log(txt);
        // document.getElementById("demo").innerHTML = txt;
    }
</script>

<script>
    $('.panelsub_all').hide();

    $('.btn_showIssues').click(function(e) {
        e.preventDefault();
        $('.subappoint').hide();
        $('.subissues').show();
        $('.subcomment').hide();
        $(this).addClass('active');
        $('.btn_showComments').removeClass('active')
        $('.btn_showAppointments').removeClass('active')
        $("#resultcomment").empty();
    });

    $('.btn_showComments').click(function(e) {
        e.preventDefault();
        $('.subappoint').hide();
        $('.subissues').hide();
        $('.subcomment').show();
        $(this).addClass('active');
        $('.btn_showAppointments').removeClass('active')
        $('.btn_showIssues').removeClass('active')
    });

    $(document).ready(function() {

        $('#savecomment').on('click', function(e) {
            e.preventDefault();
            var form = $('#addformcomment')[0];
            // alert("Data Saved");

            var data = new FormData(form);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "/comments-add",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function(response) {
                    console.log(response);
                    // alert("Data Saved");
                    // $('#savecomment').attr('disabled', 'disabled');
                    // $('#CComment').attr('readonly', 'readonly');
                    $("#resultcomment").html('<div class="alert alert-success" role="alert" id="result">Comments Save Success</div>');
                    $('#cardcomment').empty();
                    $('#countcomment').empty();
                    var temp = $('#Ctemp').val();
                    $.ajax({
                        type: "POST",
                        data: {
                            temp: temp
                        },
                        url: "/api/commentlist",
                        success: function(response) {
                            $('#savecomment').removeAttr('disabled');
                            $('#CComment').removeAttr('readonly').val("");
                            // $("#resultcomment").empty();
                            $('#image').val("");
                            var len = response.length;
                            if (len > 0) {
                                var irow = response.length;
                                var i = 0;
                                var rown = 1;
                                var html2 = '<br><h4 class="card-title">';
                                html2 += 'Comments (' + response.length + ')';
                                html2 += '</h4>';
                                for (i = 0; i < irow; i++) {
                                    var html = '<div class="card-header">';
                                    html += '<div class="user-block">';
                                    if (response[i].image != null) {
                                        // html += '<td><img src="http://10.57.34.148:8000/storage/' + response[i].Image + '" alt="image" width="80" height="80"></td>';
                                        html += '<img class="img-circle" src="/storage/' + response[i].image + '" alt="Image" width="50" height="50"> &nbsp;';
                                    }
                                    html += '<span class="username">' + response[i].Createby + ' : </span>';
                                    html += '<span class="description">' + response[i].created_at + ' </span>';
                                    if (response[i].Type == 1) {
                                        html += '<span class="description">: App </span>';
                                    }
                                    if (response[i].Type == 0) {
                                        html += '<span class="description">: Web </span>';
                                    }
                                    if (response[i].Status === 1) {
                                        html += '<span class="description" style="color: green;">#Active</span>';
                                    }
                                    if (response[i].Status === 0) {
                                        html += '<span class="description" style="color: red;">#UnActive</span>';
                                    }
                                    html += '</div>';
                                    html += '</div>';
                                    html += '<div class="card-body">';
                                    if (response[i].Status === 1) {
                                        html += '<button id="Unsend1" type="button" OnClick="JavaScript:fncConfirm1(' + response[i].Commentid + ');"  class="btn btn-default btn-sm float-right"><i class="fas fa-comment-slash"></i></i> Unsend</button>'
                                    }
                                    if (response[i].Image != null) {
                                        html += '<img class="img-fluid pad center" src="/storage/' + response[i].Image + '" style="align-items: center;" width="555" height="550" alt="Photo">';
                                    } else {
                                        html += '<p style="padding-top: 20px;">ไม่มีรูปภาพ</p>';
                                    }
                                    html += '<p style="padding-top: 20px;">' + response[i].Comment + '</p>';
                                    html += '<span class="float-right text-muted">updated ' + response[i].updated_at + ' By ' + response[i].Updateby + '</span>';
                                    html += '</div>';
                                    html += '<div class="card-footer">';
                                    html += '<bt>';
                                    html += '</div>';

                                    $('#cardcomment').append(html);
                                }
                                $('#countcomment').append(html2);
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                },
                error: function(error) {
                    console.log(error);
                    // alert("Data error");

                }
            });
        });
    });
</script>

@endsection