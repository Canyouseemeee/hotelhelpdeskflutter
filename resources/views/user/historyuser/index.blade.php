@extends('layouts.masteruser')

@section('title')
Web Test
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">History</h4>
            </div>
            <div class="card-body">
                <table id="datatable" class="table">
                    <thead class="text-primary">
                        <th>ID</th>
                        <th>Issuesid</th>
                        <th>Users</th>
                        <th>Actions</th>
                        <th>Create_at</th>
                    </thead>
                    <tbody>
                        @foreach($issuesLogs as $row)
                        <tr>
                            <td>{{$row->logs_id}}</td>
                            <td>{{$row->Issuesid}}</td>
                            <td>{{$row->Createby}}</td>
                            <td>{{$row->Action}}</td>
                            <td>{{$row->create_at}}</td>
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