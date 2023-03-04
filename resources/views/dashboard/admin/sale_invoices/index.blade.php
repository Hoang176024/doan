@extends('dashboard.layouts.app')
@section('title', 'Hóa Đơn Bán Hàng')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản Lý Hóa Đơn Bán Hàng</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang Chủ</a></li>
                            <li class="breadcrumb-item active">Hóa Đơn Bán Hàng</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tất Cả Hóa Đơn Bán Hàng</h3>
                                <a href="{{route('admin.saleInvoices.create')}}"
                                   class="btn btn-primary fa-pull-right">Thêm Mới</a>
                            </div>

                            <div class="card-body">
                                <table id="table-saleInvoices"
                                       class="table table-bordered table-striped display nowrap">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã</th>
                                        <th>Trạng Thái</th>
                                        <th>Khách Hàng</th>
                                        <th>Giao Đến</th>
                                        <th>Thuế</th>
                                        <th>Tiền Hàng</th>
                                        <th>Phí Ship</th>
                                        <th>Tiền Thuế</th>
                                        <th>Chiết Khấu Đơn</th>
                                        <th>Tổng Cộng</th>
                                        <th>Ghi Chú</th>
                                        <th>Thanh Toán</th>
                                        <th>Người Tạo</th>
                                        <th>Ngày Tạo</th>
                                        <th>Quản Lý</th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã</th>
                                        <th>Trạng Thái</th>
                                        <th>Khách Hàng</th>
                                        <th>Giao Đến</th>
                                        <th>Thuế</th>
                                        <th>Tiền Hàng</th>
                                        <th>Phí Ship</th>
                                        <th>Tiền Thuế</th>
                                        <th>Chiết Khấu Đơn</th>
                                        <th>Tổng Cộng</th>
                                        <th>Ghi Chú</th>
                                        <th>Thanh Toán</th>
                                        <th>Người Tạo</th>
                                        <th>Ngày Tạo</th>
                                        <th>Quản Lý</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Modal See Detail of one Sale Invoices -->
    <div class="modal fade" id="saleInvoiceDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi Tiết Hóa Đơn Bán Hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="detail_information" class="row">

                    </div>
                </div>
                <div class="modal-footer" id="modalFooter">
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
        @php session()->forget('success'); @endphp
        @endif

        @if(session('error'))
        toastr.error('{{session("error")}}', 'Thất Bại !', {timeOut: 5000});
        @php session()->forget('error');@endphp
        @endif
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            //JS Custom dataTable
            $("#table-saleInvoices").DataTable({
                scrollX: true, lengthChange: false, autoWidth: false,
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
                ajax: "{{route('admin.saleInvoices.list')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'code', name: 'code'},
                    {data:'status', name:'status'},
                    {data: 'customer_id', name: 'customer_id'},
                    {data: 'delivery_to', name: 'delivery_to'},
                    {data: 'tax_id', name: 'tax_id'},
                    {data: 'total_price_product', name: 'total_price_product'},
                    {data: 'delivery_fee', name: 'delivery_fee'},
                    {data: 'tax_fee', name: 'tax_fee'},
                    {data: 'discount_invoice', name: 'discount_invoice'},
                    {data: 'total_last', name: 'total_last'},
                    {data: 'note', name: 'note'},
                    {data: 'payment', name: 'payment'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: 'actions'},
                ],
            }).buttons().container().appendTo('#table-purchases_wrapper .col-md-6:eq(0)');

            $(document).on('click', '.btn_detail', function () {
                $('#saleInvoiceDetail').modal('show');
                var saleInvoiceId = $(this).val();
                var html ='<a href="https://pos_team3.example.com/saleInvoices/print-pdf/'+saleInvoiceId+'" class="btn btn-success">In PDF</a>';
                html += '<button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>';
                $('#modalFooter').html(html);
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.saleInvoices.detail')}}",
                    data: {saleInvoiceId: saleInvoiceId},
                    success: function (data) {
                        if (data) {
                            $('#detail_information').html(data);
                        }
                    }
                });
            });

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var saleInvoiceId = $(this).val();
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

                Swal.fire({
                    title: "Bạn có chắc muốn xóa ?", icon: "warning",
                    text: "Dữ liệu này sẽ bị xóa và không thể phục hồi :((",
                    showCancelButton: true,  showCancleButton: true,
                    confirmButtonText: "Đồng Ý", cancelButtonText: "Hủy",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{route('admin.saleInvoices.delete')}}",
                            data: {saleInvoiceId: saleInvoiceId},
                            success: function (response) {
                                if (response.status == '422' || response.status == '404') {
                                    Swal.fire({title: "Xóa thất bại !", text: response.msg, icon: "error"});
                                }
                                if (response.status == '200') {
                                    Swal.fire({title: "Xóa dữ liệu thành công !", icon: "succes"});
                                    $('#table-saleInvoices').DataTable().ajax.reload(null, false);
                                }
                            }
                        });
                    } else if (result.dismiss) {
                        Swal.fire({title: "Hủy xóa dữ liệu !", icon: "info"});
                    }
                })
            });

        });
    </script>
@stop
