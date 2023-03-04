@extends('dashboard.layouts.app')
@section('title', 'Brand')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List of brands</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Brand</li>
                        </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            
                <div class="card card-default">
                    
                        <div class="card-header">
                                <h3 class="card-title">Info</h3>
                            <div class="card-tools">
                                <a class="btn btn-primary" href="{{route('admin.brands.create')}}">Create</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped display nowrap">
                                <thead>
                                    <tr>
                                        <th>Order</th>
                                        <th>Name</th>
                                        <th>Picture</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    
                </div>
            
        </div>
    </section>
</div>
@stop
@section('css')
<!-- Font Awesome -->

<!-- DataTables -->
<link rel="stylesheet" href="{{asset('css/plugins/datatables/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/datatables/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/sweetalert2/sweetalert2.min.css')}}">
<!-- Theme style -->
@stop
@section('js')

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
            lengthChange: false, autoWidth: false,
                scrollX: true,
                dom: 'lBfrtip',
                lengthMenu: [[10, 25, 50], ['10', '25', '50']],
            dom: 'lBfrtip',
            buttons: [
                "pageLength",
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

            ajax: "{{ route('admin.brands.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'photo',
                    name: 'photo',
                    
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
                            url: "{{route('admin.brands.delete')}}",
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
