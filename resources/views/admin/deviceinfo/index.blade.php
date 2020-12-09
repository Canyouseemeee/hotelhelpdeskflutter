@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div id="message">

                </div>
                <h4 class="card-title"> Device App 
                    <a href="{{ url('device-create') }}" class="btn btn-primary float-right">Add</a>
                </h4>
            </div>
            <div class="card-body">
                <table id="datatable" class="table">
                    <thead class="text-primary">
                        <th>ID</th>
                        <th>device</th>
                        <th>Active</th>
                        <th>EDIT</th>
                        <!-- <th>DELETE</th> -->
                    </thead>
                    <tbody>
                        @foreach($deviceinfo as $row)
                        <tr>
                            <input type="hidden" class="departmentdelete_val" value="{{$row->Departmentid}}">
                            <td>{{$row->deviceinfoid}}</td>
                            <td>{{$row->deviceid}}</td>
                            <td><input type="checkbox" class="toggle-class" data-id="{{$row->deviceinfoid}}" 
                            data-toggle="toggle" data-on="Enabled" data-off="Disabled" {{$row->active==true ? 'checked':''}}></td>
                            <td>
                                <a href="{{ url('device-edit/'.$row->deviceinfoid) }}" class="btn btn-success">EDIT</a>
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
    var active=$(this).prop('checked')==true ? 1:0;
    var deviceinfoid=$(this).data('id');
    // alert(Departmentid);
    $.ajax({
        type:'GET',
        dataType:'json',
        url:'{{route("change_Device")}}',
        data:{'active':active,'deviceinfoid':deviceinfoid},
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