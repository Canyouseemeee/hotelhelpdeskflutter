@extends('layouts.master')

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
?>

<div class="card-body">
    <form action="{{ url('issues-filter-defers') }}" method="post">
        {{ csrf_field() }}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Filter') }}</div>
                        <div class="card-body row ">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"> Fromdate : </label>
                                <div class="col-md-8">
                                    <input type="date" id="fromdate" name="fromdate" value="{{now()->toDateString()}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"> Todate : </label>
                                <div class="col-md-8">
                                    <input type="date" id="todate" name="todate" value="{{now()->toDateString()}}" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                @if($fromdate != null)
                                <label class="col-form-label text-md-right float-left"> Fromdate : {{$fromdate}} - Todate : {{$todate}} is quantity {{$data}} </label>
                                @endif
                                <button type="submit" class="btn btn-primary float-right">Search</button>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header py-3 ">
                <h4 class="card-title"> Defer Issues
                    <a href="{{ url('issues-create/'.$Uuidapp) }}" class="btn btn-primary float-right">Add Issues</a>
                </h4>
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
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table">
                        <thead class="text-primary">
                            <th class="w-10p">Id</th>
                            <th class="w-10p">Tracker</th>
                            <th class="w-10p">Status</th>
                            <th class="w-10p">Priority</th>
                            <th class="w-10p">Createby</th>
                            <th class="w-10p">Subject</th>
                            <th class="w-10p">Updated</th>
                            <th class="w-10p">Views</th>
                        </thead>
                        @if (!is_null($issues))
                        <tbody>
                            @foreach($issues as $row)
                            <tr>
                                <td>{{$row->Issuesid}}</td>
                                <td>{{$row->TrackName}}</td>
                                <td>{{$row->ISSName}}</td>
                                <td>{{$row->ISPName}}</td>
                                <td>{{$row->Createby}}</td>
                                <td>
                                    <div class="w-11p" style="height: 30px; overflow: hidden;">
                                        <a href="{{ url('issues-show/'.$row->Issuesid) }}">{{$row->Subject}}</a>
                                    </div>
                                </td>
                                <td>{{DateThai($row->updated_at)}}</td>
                                <td>
                                    <a href="{{ url('issues-show/'.$row->Issuesid) }}" class="btn btn-success">View</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @if (!is_null($between))
                            @foreach ($between as $betweens)
                            <tr>
                                <th scope="row">{{$betweens->Issuesid}}</th>
                                <td style="text-align:center">{{$betweens->TrackName}}</td>
                                <td style="text-align:center">{{$betweens->ISSName}}</td>
                                <td style="text-align:center">{{$betweens->ISPName}}</td>
                                <td style="text-align:center">{{$betweens->Createby}}</td>
                                <td>
                                    <div class="w-11p" style="height: 30px; overflow: hidden;">
                                        <a href="{{ url('issues-show/'.$betweens->Issuesid) }}">{{$betweens->Subject}}</a>
                                    </div>
                                </td>
                                <td style="text-align:center">{{DateThai($betweens->updated_at)}}</td>
                                <td>
                                    <a href="{{ url('issues-show/'.$betweens->Issuesid) }}" class="btn btn-success">View</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'print']
        });
    });

    $('#datatable').on('click', '.deletebtn', function() {
        $tr = $(this).closest('tr');

        var data = $tr.children('td').map(function() {
            return $(this).text();
        }).get();

        // console.log(data);

        $('#delete_department_id').val(data[0]);

        $('#delete_modal_Form').attr('action', '/department-delete/' + data[0]);

        $('#deletemodalpop').modal('show');
    });
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        var from = $('#fromdate').datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true
            }).on("change", function() {
                to.datepicker("option", "minDate", getDate(this));
            }),
            to = $('#todate').datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true
            }).on("change", function() {
                from.datepicker("option", "maxDate", getDate(this));
            });

        function getDate(element) {
            var date;
            var dateFormat = "yy-mm-dd";
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }
            return date;
        }
    });
</script>
@endsection