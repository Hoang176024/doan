@extends('dashboard.layouts.app')
@section('title', 'Sale invoice')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sale's invoice manage</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Sale's invoice</li>
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
                                <h3 class="card-title">Sale's invoices</h3>
                            </div>

                            <div class="card-body">
                                <table id="table-posInvoices"
                                       class="table table-bordered table-striped display nowrap">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Sale invoice code</th>
                                        <th>Info</th>
                                        <th>Customer</th>
                                        <th>Listed price</th>
                                        <th>Tax</th>
                                        <th>Tax fee</th>
                                        <th>Invoice Discount</th>
                                        <th>Total</th>
                                        <th>Note</th>
                                        <th>Type of payment</th>
                                        <th>Creator</th>
                                        <th>Role</th>
                                        <th>Time</th>

                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                    
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

    <!-- Modal See Detail of one Pos Invoices -->
    <div class="modal fade" id="posInvoiceDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">POS's invoice information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="detail_information" class="row"></div>
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
        toastr.success('{{session("success")}}', 'Success !', {timeOut: 5000});
        @php session()->forget('success'); @endphp
        @endif

        @if(session('error'))
        toastr.error('{{session("error")}}', 'Failed !', {timeOut: 5000});
        @php session()->forget('error');@endphp
        @endif
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            //JS Custom dataTable
            $("#table-posInvoices").DataTable({
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
                ajax: "{{route('admin.posInvoices.list')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'code', name: 'code'},
                    {data: 'actions', name: 'actions'},
                    {data: 'customer_name', name: 'customer_name'},
                    {data: 'total_price_product', name: 'total_price_product'},
                    {data: 'tax_id', name: 'tax_id'},
                    {data: 'tax_fee', name: 'tax_fee'},
                    {data: 'discount_invoice', name: 'discount_invoice'},
                    {data: 'total_last', name: 'total_last'},
                    {data: 'note', name: 'note'},
                    {data: 'payment', name: 'payment'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'user_role', name: 'user_role'},
                    {data: 'date', name: 'date'}
                ],
            }).buttons().container().appendTo('#table-posInvoices_wrapper .col-md-6:eq(0)');

            $(document).on('click', '.btn_detail', function () {
                $('#posInvoiceDetail').modal('show');
                var posInvoiceId = $(this).val();
                var html = '<a href="https://pos_team3.example.com/posInvoices/print-pdf/' + posInvoiceId + '" class="btn btn-success">Print PDF</a>';
                html += '<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>';
                $('#modalFooter').html(html);
                $.ajax({
                    type: "GET",
                    url: "{{route('admin.posInvoices.detail')}}",
                    data: {posInvoiceId: posInvoiceId},
                    success: function (data) {
                        if (data) {
                            $('#detail_information').html(data);
                        }
                    }
                });
            });
        });
    </script>
@stop
