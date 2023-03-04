@extends('dashboard.layouts.app')
@section('title', 'Units')
@section('css')
 <link rel="stylesheet" href="{{asset('css/plugins/datatables/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/plugins/datatables/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/plugins/datatables/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/plugins/sweetalert2/sweetalert2.min.css')}}">
@stop
@section('content')
     <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-10">
                        <h1 class="m-0">Table of unit</h1>
                    </div><!-- /.col -->
                    
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
         
       
        <!-- Main content -->
       
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Information</h3>
                                <div class="card-tools">
                                <a class="btn btn-primary" href="{{route('admin.units.create')}}">Create Unit</a>
                            </div><!-- /.col -->
                            </div>
                            <div class="card-body ">
                                <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                    <th>Order</th>
                                    <th>Unit Code</th>
                                    <th>Unit Name</th>
                                    <th>Action</th>
                                   
                                  </tr>
                                  </thead>
                                 </table>
                               </div>
                        </div>
                        <!-- /.card -->
                    
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    </div>
@stop
<!-- Modal -->


@section('js')
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

 <script type="text/javascript">
     
$(document).ready(function(){
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

        
        ajax: "{{ route('admin.units.index')}}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'unit_code', name: 'unit_code' },
            { data: 'unit_name', name: 'unit_name' },
            { data: 'action', name: 'action', orderable: false }
        ]
        
    }).buttons() .container() .appendTo('#example1_wrapper .col-md-6:eq(0)');
    
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
                            url: "{{route('admin.units.delete')}}",
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


