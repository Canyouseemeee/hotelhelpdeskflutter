@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')

<!-- Delete Modal -->
<div class="modal fade" id="deletemodalpop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DELETE FORM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="delete_modal_Form" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <input type="hidden" id="delete_department_id">
                    <h5>Are you sure.? you want to delete this Data</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Yes. Delete It.</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Delete Modal -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div id="message">

                </div>
                <h4 class="card-title"> Department 
                    <a href="{{ url('department-create') }}" class="btn btn-primary float-right">Add</a>
                </h4>
            </div>
            <div class="card-body">
                <table id="datatable" class="table">
                    <thead class="text-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Active</th>
                        <th>EDIT</th>
                        <!-- <th>DELETE</th> -->
                    </thead>
                    <tbody>
                        @foreach($department as $row)
                        <tr>
                            <input type="hidden" class="departmentdelete_val" value="{{$row->Departmentid}}">
                            <td>{{$row->Departmentid}}</td>
                            <td>{{$row->DmName}}</td>
                            <td>{{$row->DmCode}}</td>
                            <td><input type="checkbox" class="toggle-class" data-id="{{$row->Departmentid}}" 
                            data-toggle="toggle" data-on="Enabled" data-off="Disabled" {{$row->DmStatus==true ? 'checked':''}}></td>
                            <td>
                                <a href="{{ url('department-edit/'.$row->Departmentid) }}" class="btn btn-success">EDIT</a>
                            </td>
                            <!-- <td>
                                <a href="javascript:void(0)" class="btn btn-danger btn-circle deletebtn" data-toggle="modal" data-target="#deletemodalpop"><i class="fas fa-trash"></i></a>
                            </td> -->
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
  $(function() {
    $('#toggle-two').bootstrapToggle({
      on: 'Enabled',
      off: 'Disabled',
      onstyle: 'primary'
    });
  });

  $('.toggle-class').on('change',function(){
    var DmStatus=$(this).prop('checked')==true ? 1:0;
    var Departmentid=$(this).data('id');
    // alert(Departmentid);
    $.ajax({
        type:'GET',
        dataType:'json',
        url:'{{route("change_Status")}}',
        data:{'DmStatus':DmStatus,'Departmentid':Departmentid},
        success:function(data){
            $('.message').html('<p class="alert alert-danger">'+data.success+'</p>');
        }
    });
  });
  
</script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable();

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
    });
</script>
@endsection