@extends('layouts.masteruser')

@section('title')
Web Test
@endsection

@section('content')

<?php
function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear $strHour:$strMinute น.";
}

function DateThai2($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear $strHour:$strMinute น.";
}

function formatdate($strDate)
{
    $dateinterval = $strDate;
    return $dateinterval->format('%D day %H:%I:%S');
}

function DateTime($strDate)
{

    $newDate = date('Y-m-d\TH:i', strtotime($strDate));
    return "$newDate";
}

?>

<!-- The Modal -->
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>


<button type="button" class="btn btn-outline-warning btn_showIssues active">Issues Create</button>
<button type="button" class="btn btn-outline-primary btn_showComments">Comments</button>
<button type="button" class="btn btn-outline-danger btn_showAppointments">Appointments</button>


<form action="{{ url('issues-show-user/'.$data->Issuesid) }}" method="PUT">
    {{ csrf_field() }}
    <div class="row subissues">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Issues-View</h4>
                </div>
                <style>
                    .SandD {
                        width: 900px;
                        word-wrap: break-word;
                    }

                    #myImg {
                        border-radius: 5px;
                        cursor: pointer;
                        transition: 0.3s;
                    }

                    #myImg:hover {
                        opacity: 0.7;
                    }

                    /* The Modal (background) */
                    .modal {
                        display: none;
                        /* Hidden by default */
                        position: fixed;
                        /* Stay in place */
                        z-index: 1;
                        /* Sit on top */
                        padding-top: 100px;
                        /* Location of the box */
                        left: 0;
                        top: 0;
                        width: 100%;
                        /* Full width */
                        height: 100%;
                        /* Full height */
                        overflow: auto;
                        /* Enable scroll if needed */
                        background-color: rgb(0, 0, 0);
                        /* Fallback color */
                        background-color: rgba(0, 0, 0, 0.9);
                        /* Black w/ opacity */
                    }

                    /* Modal Content (Image) */
                    .modal-content {
                        margin: auto;
                        display: block;
                        width: 80%;
                        max-width: 700px;
                    }

                    /* Caption of Modal Image (Image Text) - Same Width as the Image */
                    #caption {
                        margin: auto;
                        display: block;
                        width: 80%;
                        max-width: 700px;
                        text-align: center;
                        color: #ccc;
                        padding: 10px 0;
                        height: 150px;
                    }

                    /* Add Animation - Zoom in the Modal */
                    .modal-content,
                    #caption {
                        animation-name: zoom;
                        animation-duration: 0.6s;
                    }

                    @keyframes zoom {
                        from {
                            transform: scale(0)
                        }

                        to {
                            transform: scale(1)
                        }
                    }

                    /* The Close Button */
                    .close {
                        position: absolute;
                        top: 15px;
                        right: 35px;
                        color: #f1f1f1;
                        font-size: 40px;
                        font-weight: bold;
                        transition: 0.3s;
                    }

                    .close:hover,
                    .close:focus {
                        color: #bbb;
                        text-decoration: none;
                        cursor: pointer;
                    }

                    /* 100% Image Width on Smaller Screens */
                    @media only screen and (max-width: 700px) {
                        .modal-content {
                            width: 100%;
                        }
                    }
                </style>
                <div class="container">
                    <div class="card-body row">
                        <div class="" style="font-size:20px">
                            <div class="form-row ">
                                <div class="form-group col-md-3">
                                    <b> <label>Tracker : </label></b>
                                    @foreach($trackname as $row)
                                    @if ($row->Trackerid === $data->Trackerid)
                                    <label>{{$row->TrackName}}</label>
                                    @endif
                                    @endforeach
                                </div>

                                <div class="form-group col-md-3">
                                    <b> <label>SubTracker : </label></b>
                                    @foreach($trackname as $row)
                                    @if ($row->Trackerid === $data->Trackerid)
                                    <label>{{$row->SubTrackName}}</label>
                                    @endif
                                    @endforeach
                                </div>

                                <div class="form-group col-md-3">
                                    <b> <label>TrackName : </label></b>
                                    @foreach($trackname as $row)
                                    @if ($row->Trackerid === $data->Trackerid)
                                    <label>{{$row->Name}}</label>
                                    @endif
                                    @endforeach
                                </div>

                                <div class="form-group col-md-3">
                                    <b> <label>Priority : </label></b>
                                    @foreach($issuespriority as $row2)
                                    @if ($row2->Priorityid === $data->Priorityid)
                                    <label>{{$row2->ISPName}}</label>
                                    @endif
                                    @endforeach
                                </div>

                                <div class="form-group col-md-3">
                                    <b> <label>Status : </label></b>
                                    @foreach($issuesstatus as $row3)
                                    @if ($row3->Statusid === $data->Statusid)
                                    <label>{{$row3->ISSName}}</label>
                                    @endif
                                    @endforeach
                                </div>

                                <div class="form-group col-md-7">
                                    <b> <label>Department : </label></b>
                                    @foreach($department as $row4)
                                    @if ($row4->Departmentid === $data->Departmentid)
                                    <label>{{$row4->DmCode}}-{{$row4->DmName}}</label>
                                    @endif
                                    @endforeach
                                </div>

                                <div class="form-group col-md-3">
                                    <b> <label>Tel : </label></b>
                                    <label>{{$data->Tel}}</label>
                                </div>

                                <div class="form-group col-md-3">
                                    <b> <label>Comname : </label></b>
                                    <label>{{$data->Comname}}</label>
                                </div>

                                <div class="form-group col-md-3">
                                    <b> <label>Assignment : </label></b>
                                    @foreach($user as $row5)
                                    @if ($row5->id === $data->Assignment)
                                    <label>{{$row5->name}}</label>
                                    @endif
                                    @endforeach
                                </div>

                                <div class="form-group col-md-3">
                                    <b> <label>Informer : </label></b>
                                    <label>{{$data->Informer}}</label>
                                </div>
                            </div>

                            <b><label>Subject : </label></b>
                            <div class="form-group col-md-10">
                                <label class="SandD">{{$data->Subject}}</label>
                            </div>


                            <b><label>Description : </label></b>
                            <div class="form-group col-md-10">
                                <label class="SandD">{{$data->Description}}</label>
                            </div>

                            <div class="form-row ">
                                <div class="form-group col-md-4">
                                    <b> <label>Createby : </label></b>
                                    <label>{{$data->Createby}}</label>
                                </div>

                                <div class="form-group col-md-4">
                                    <b> <label>Updatedby : </label></b>
                                    <label>{{$data->Updatedby}}</label>
                                </div>

                                <div class="form-group col-md-3">
                                    <b> <label>Closedby : </label></b>
                                    @if($data->Statusid === 1 || $data->Statusid === 3 || $data->Closedby === null)
                                    <label>ยังไม่ปิดงาน</label>
                                    @else
                                    <label>{{$data->Closedby}}</label>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <b> <label>Created : </label></b>
                                    <label>{{DateThai($data->created_at)}}</label>
                                </div>

                                <div class="form-group col-md-4">
                                    <b> <label>Updated : </label></b>
                                    <label>{{DateThai2($data->updated_at)}}</label>
                                </div>

                                <div class="form-group col-md-4">
                                    <b> <label>Closed : </label></b>
                                    @if($data->Statusid === 1 || $data->Statusid === 3)
                                    <label>ยังไม่ปิดงาน</label>
                                    @else
                                    @foreach($issueslog as $log)
                                    <label>{{DateThai2($log->create_at)}}</label>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <b> <label>Spend Time : </label></b>
                                    @if($data->Statusid === 1 || $data->Statusid === 3)
                                    <label>ยังไม่ปิดงาน</label>
                                    @else
                                    <label>{{($dateinterval)->format('%d วัน %H:%I:%S น.')}}</label>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <b><label>Image : </label></b>
                                <img id="myImg" src="{{ url('storage/'.$data->Image) }}" alt="Image" style="width:100%;max-width:300px">
                            </div>

                        </div>
                        <a href="{{ url('issues-edit-user/'.$data->Issuesid.'/'.$data->Uuid) }}" class="btn btn-primary">Edit</a>
                        &nbsp;&nbsp;
                        <a href="/issues-user" class="btn btn-danger">Back</a>
                        &nbsp;&nbsp;
                        <a href="{{ url('pdf/'.$data->Issuesid)}}" class="btn btn-warning"> PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row panelsub_all subappoint">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Appointment Issues </h4>

            </div>
            <style>
                .w-10p {
                    width: 10% !important;
                }

                .w-11p {
                    width: 300px;
                    word-break: 'break-all';
                }
            </style>
            <div class="card-body" id="refresh">
                @if(!is_null($appointment))
                <table id="datatableappoint" class="table">
                    <thead class="text-primary">
                        <th>Date</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Createby</th>
                        <th>Updateby</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                    </thead>
                    <tbody id="datatableappointbody">
                        @foreach($appointment as $row)
                        <tr>
                            <td>{{$row->Date}}</td>
                            <td>
                                <div class="w-11p" style="height: 30px; overflow: hidden;">
                                    {{$row->Comment}}
                                </div>
                            </td>
                            @if($row->Status === 1)
                            <td>Active</td>
                            @elseif($row->Status === 2)
                            <td>Change</td>
                            @elseif($row->Status === 3)
                            <td>Disable</td>
                            @endif
                            <td>{{$row->Createby}}</td>
                            <td>{{$row->Updateby}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->updated_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <table id="datatableappoint" class="table">
                    <thead class="text-primary">
                        <th>Date</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Createby</th>
                        <th>Updateby</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                    </thead>
                    <tbody id="datatableappointbody">
                        <tr>
                            <td>ไม่มีข้อมูลที่จะแสดง</td>
                            <td>ไม่มีข้อมูลที่จะแสดง</td>
                            <td>ไม่มีข้อมูลที่จะแสดง</td>
                            <td>ไม่มีข้อมูลที่จะแสดง</td>
                            <td>ไม่มีข้อมูลที่จะแสดง</td>
                            <td>ไม่มีข้อมูลที่จะแสดง</td>
                            <td>ไม่มีข้อมูลที่จะแสดง</td>
                        </tr>
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>

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
            <h4 class="card-title"> Comments </h4>
        </div>
        <div class="card card-widget" id="cardcomment">
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
    $('.panelsub_all').hide();

    $('.btn_showAppointments').click(function(e) {
        e.preventDefault();
        $('.subappoint').show();
        $('.subissues').hide();
        $('.subcomment').hide();
        $(this).addClass('active');
        $('.btn_showIssues').removeClass('active')
        $('.btn_showComments').removeClass('active')
    });

    $('.btn_showIssues').click(function(e) {
        e.preventDefault();
        $('.subappoint').hide();
        $('.subissues').show();
        $('.subcomment').hide();
        $(this).addClass('active');
        $('.btn_showComments').removeClass('active')
        $('.btn_showAppointments').removeClass('active')
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
</script>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    img.onclick = function() {
        document.getElementById("myModal").style.display = 'block';
        modalImg.src = this.src;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
</script>

@endsection