@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Checkin-Checkout</h4>
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
                <table id="datatable" class="table">
                    <thead class="text-primary">
                        <th>Issuesid</th>
                        <th>Status</th>
                        <th>Detail</th>
                        <th>Createby</th>
                        <th>Updateby</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                    </thead>
                    <tbody>
                        @foreach($issuesCheckin as $row)
                        <tr>
                            <td>
                                <a href="{{ url('issues-show/'.$row->Issuesid) }}">{{$row->Issuesid}}</a>
                            </td>
                            @if($row->Status === 1)
                            <td>Active</td>
                            @elseif($row->Status === 2)
                            <td>Closed</td>
                            @elseif($row->Status === 3)
                            <td>Keep on</td>
                            @endif
                            <td>
                                <div class="w-11p" style="height: 30px; overflow: hidden;">
                                    {{$row->Detail}}
                                </div>
                            </td>
                            <td>{{$row->Createby}}</td>
                            <td>{{$row->Updateby}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->updated_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Page level plugins -->
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="/js/demo/datatables-demo.js"></script>
<script src="{{ asset('js/dataTables.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable();

        $('#datatable').on('click', '.deletebtn', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children('td').map(function() {
                return $(this).text();
            }).get();

            // console.log(data);

            $('#delete_priority_id').val(data[0]);

            $('#delete_modal_Form').attr('action', '/priority-delete/' + data[0]);

            $('#deletemodalpop').modal('show');
        });
    });
</script>
@endsection