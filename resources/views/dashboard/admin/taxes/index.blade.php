@extends('dashboard.layouts.app')
@section('title', 'Tax')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1 class="m-0">Tax list</h1>
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
                            <h3 class="card-title">Info</h3>
                                <div class="card-tools">
                                    <a href="{{route('admin.taxes.create')}}" class="btn btn-primary">Create</a>
                                </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Name</th>
                                        <th>Tax %</th>
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
<link rel="stylesheet" href="{{asset('css/plugins/sweetalert2/sweetalert2.min.css')}}">
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
<script src="{{asset('js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

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

            ajax: "{{ route('admin.taxes.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'rate',
                    name: 'rate',
                    
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        
        // Modal Delete
        $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var id = $(this).val();
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

                Swal.fire({
                    title: "Are you sure want to delete?", icon: "warning",
                    text: "This data will be delete and cannot recover :((",
                    showCancelButton: true,  showCancleButton: true,
                    confirmButtonText: "YES", cancelButtonText: "CANCEL",
                }).then((result) =>  {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{route('admin.taxes.delete')}}",
                            data: {id: id},
                            success: function (response) {
                                if (response.status == '422' || response.status == '404') {
                                    Swal.fire({title: "Delete fail !", text: response.msg, icon: "error"});
                                }
                                if (response.status == '200') {
                                    Swal.fire({title: "Delete success !", icon: "success"});

                                    $('#example1').DataTable().ajax.reload(null, false);
                                }
                            }
                        });
                    }else if (result.dismiss) {
                        Swal.fire({title: "Canceled !", icon: "info"});
                    }
                });
            });
    });
</script>
@stop
