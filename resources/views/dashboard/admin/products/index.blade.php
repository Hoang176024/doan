@extends('dashboard.layouts.app')
@section('title', 'Product')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product manage</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Product info</h3>
                        <div class="card-tools">
                            <a href="{{route('admin.products.create')}}" class="btn btn-primary">Create</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="table-products" class="table table-bordered table-striped display nowrap">
                            <thead>
                            <tr>
                                <th>Order</th>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Purchase price</th>
                                <th>Selling price</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                            
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->

    <!-- Modal See Detail of one Products-->
    <div class="modal fade" id="productDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail of product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="detail_information" class="row"></div>
                </div>
                <div class="modal-footer" id="modalFooter">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('css/plugins/datatables/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/datatables/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/sweetalert2/sweetalert2.min.css')}}">
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

    <script type="text/javascript">
        @if(session('success'))
        toastr.success('{{session("success")}}', 'Thành Công !', {timeOut: 5000});
        @php
            session()->forget('success');
        @endphp
        @endif

        @if(session('error'))
        toastr.error('{{session("error")}}', 'Thất Bại !', {timeOut: 5000});
        @php session()->forget('error');@endphp
        @endif
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            //JS Custom dataTable
            $("#table-products").DataTable({
                lengthChange: false, autoWidth: false,
                scrollX: true,
                dom: 'lBfrtip',
                lengthMenu: [[10, 25, 50], ['10', '25', '50']],
                buttons: ["pageLength", "copy",
                    {
                        extend: 'csvHtml5',
                        charset: 'utf-8',
                        bom: true,
                        text: window.csvButtonTrans,
                        exportOptions: {columns: ':visible'}
                    },
                    {
                        extend: 'excel',
                        text: window.excelButtonTrans,
                        exportOptions: {columns: ':visible'}
                    },
                    {
                        extend: 'pdf',
                        text: window.pdfButtonTrans,
                        exportOptions: {columns: ':visible'}

                    }, {
                        extend: 'print',
                        text: window.printButtonTrans,
                        exportOptions: {columns: ':visible'}
                    }, "colvis"],
                ajax: "{{route('admin.products.getList')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {
                        data: 'photo_url', name: 'photo',
                        render: function (data) {
                            if (data == null) {
                                return "<img src={{asset('image/no_img.png')}} width='50px' height='50px'/>"
                            } else {
                                return "<img src=" + data + " width='50px' height='50px'/>"
                            }
                        }
                    },
                    {data: 'name', name: 'name'},
                    {data: 'brand_id', name: 'brand_id'},
                    {data: 'price_in', name: 'price_in'},
                    {data: 'price_out', name: 'price_out'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'unit_id', name: 'unit_id'},
                    {data: 'actions', name: 'actions'},
                ],
            }).buttons().container().appendTo('#table-products_wrapper .col-md-6:eq(0)');

            $(document).on('click', '.btn_detail', function(e){
                $('#productDetail').modal('show');
                var productId = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.products.detail')}}",
                    data: {productId : productId},
                    success: function (data) {
                        if (data) {
                            $('#detail_information').html(data);
                        }
                    }
                });
            });

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var productId = $(this).val();
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

                Swal.fire({
                    title: "Are you sure you want to delete this product ?", icon: "warning",
                    text: "Data will be lost and cannot be recoverd :((",
                    showCancelButton: true,  showCancleButton: true,
                    confirmButtonText: "YES", cancelButtonText: "CANCEL",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{route('admin.products.delete')}}",
                            data: {productId:productId},
                            success: function (response) {
                                if (response.status == '422' || response.status == '404') {
                                    Swal.fire({title: "Failed to delete !", text: response.msg, icon: "error"});
                                }
                                if (response.status == '200') {
                                    Swal.fire({title: "Successfully deleted !", icon: "succes"});
                                    $('#table-products').DataTable().ajax.reload(null, false);
                                }
                            }
                        });
                    } else if (result.dismiss) {
                        Swal.fire({title: "Canceled !", icon: "info"});
                    }
                })
            });
        });
    </script>

@stop









