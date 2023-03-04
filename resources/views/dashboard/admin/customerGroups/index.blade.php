@extends('dashboard.layouts.app')
@section('title', 'Customer tier')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1 class="m-0">Customer tier list</h1>
                </div>
                
            </div>
        </div>
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin mô tả</h3>
                            <div class="card-tools">
                            <a href="{{route('admin.customerGroups.create')}}" class="btn btn-primary">Create</a>
                        </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
@section('css')
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('css/plugins/fontawesome-free/all.min.css')}}">
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('css/plugins/datatables/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('css/plugins/datatables/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('css/plugins/datatables/buttons.bootstrap4.min.css')}}">
<!-- Theme style -->
@stop
@section('js')
<!-- Bootstrap 4 -->
<script src="{{asset('js/plugins/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('js/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('js/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('js/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/buttons.colVis.min.js')}}"></script>
<script>
    $(function() {

        $('#example1').DataTable({
            processing: true,
            serverSide: false,

            responsive: true,
            lengthChange: false,
            autoWidth: false,
            dom: 'lBfrtip',
            buttons: [
                "copy",
                {
                    extend: "csv",
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: "pdf",
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: "print",
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                "colvis"
            ],

            ajax: "{{ route('admin.customerGroups.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
        // Modal Delete
        var customerGroup_id;
        $(document).on('click', '.delete', function() {
            customerGroup_id = $(this).attr('id');
            $('#deleteModal').modal('show');
        });
        $('#ok_button').click(function() {
            $.ajax({
                url: "/customerGroups/delete/" + customerGroup_id,
                beforeSend: function() {
                    $('#ok_button').text('Deleting...');
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#deleteModal').modal('hide');
                        $('#example1').DataTable().ajax.reload();
                        alert('Data deleted');
                    }, 1000);
                },
            })
        });
    });
</script>
@stop
@section('modal')
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Tier!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                Are you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" name="ok_button" id="ok_button">Delete</button>
            </div>
        </div>
    </div>
</div>
@stop