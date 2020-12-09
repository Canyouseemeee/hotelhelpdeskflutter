@extends('layouts.master')

@section('title')
Web Test
@endsection

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add About Us</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/save-aboutus" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Title :</label>
                        <input type="text" name="title" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Sub-Title :</label>
                        <input type="text" name="subtitle" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Description :</label>
                        <textarea name="description" class="form-control" id="recipient-name"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
                    <input type="hidden" id="delete_aboutus_id">
                    <h5>Are you sure.? you want to delete this Data</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes. Delete It.</button>
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
                <h4 class="card-title"> About Us
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">Add</button>
                </h4>
            </div>
            <style>
                .w-10p {
                    /* width: 10% !important; */
                    word-break:break-all;
                    width: 600px ;
                }
            </style>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table">
                        <thead class="text-primary">
                            <th>Id</th>
                            <th>Title</th>
                            <th>Sub-Title</th>
                            <th>Description</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </thead>
                        <tbody>
                            @foreach($aboutus as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->title}}</td>
                                <td>{{$row->subtitle}}</td>
                                <td class="w-10p">
                                    <div style="height: 30px; overflow: hidden;">
                                        {{$row->description}}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ url('about-us/'.$row->id) }}" class="btn btn-success">EDIT</a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger deletebtn">DELETE</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();

        $('#datatable').on('click', '.deletebtn', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children('td').map(function() {
                return $(this).text();
            }).get();

            // console.log(data);

            $('#delete_aboutus_id').val(data[0]);

            $('#delete_modal_Form').attr('action', '/about-us-delete/' + data[0]);

            $('#deletemodalpop').modal('show');
        });
    });
</script>
@endsection