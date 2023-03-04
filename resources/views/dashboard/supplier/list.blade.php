@extends('dashboard.layouts.app')
@section('title', 'Supplier')
@section('css')

    <link rel="stylesheet" href="{{asset('css/plugins/datatables/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/datatables/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/sweetalert2/sweetalert2.min.css')}}">

@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Supplier</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Supplier</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                    <div class="card-header">
                                <h3 class="card-title">Information</h3>
                                <div class="card-tools">
                                <a class="btn btn-primary" href="{{route('admin.suppliers.create')}}">Create</a>
                            </div><!-- /.col -->
                            </div>

                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="suppliers-table">
                                <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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


<script type=text/javascript>
    $(document).ready(function(){
        
        $("#suppliers-table").DataTable({
            responsive: true, lengthChange: false, autoWidth: false,
            dom: 'lBfrtip',
            lengthMenu: [[10, 25, 50], ['10', '25', '50']],
            buttons: [
                "pageLength","copy",
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
            ajax:{
            url:"{{ route('admin.suppliers.index') }}",
        	},
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'address', name: 'address' },
                { data: 'phone', name: 'phone' },
                { data: 'email', name: 'email' },
                { data: 'action', name: 'action', orderable: false }
            ]
        }).buttons().container().appendTo('#suppliers-table_wrapper .col-md-6:eq(0)');
        
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
                            url: "{{route('admin.suppliers.delete')}}",
                            data: {id: id},
                            success: function (response) {
                                if (response.status == '422' || response.status == '404') {
                                    Swal.fire({title: "Delete fail !", text: response.msg, icon: "error"});
                                }
                                if (response.status == '200') {
                                    Swal.fire({title: "Delete success !", icon: "success"});

                                    $("#suppliers-table").DataTable().ajax.reload(null, false);
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


