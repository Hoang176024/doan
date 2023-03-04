@extends('dashboard.layouts.app')
@section('title', 'Vận Chuyển')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quản Lý Thông Tin Vận Chuyển</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang Chủ</a></li>
                            <li class="breadcrumb-item active">Vận Chuyển</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                {{--Form Update Password--}}
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Thông Tin Vận Chuyển</h3>
                        <div class="card-tools">
                            <a href="{{route('admin.deliveries.create')}}" class="btn btn-primary">Thêm Mới</a>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="table-deliveries" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tỉnh/Thành Phố</th>
                                <th>Quận Huyện</th>
                                <th>Xã/Phường/Thị Trấn</th>
                                <th>Phí</th>
                                <th>Quản Lý</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tỉnh/Thành Phố</th>
                                <th>Quận Huyện</th>
                                <th>Xã/Phường/Thị Trấn</th>
                                <th>Phí</th>
                                <th>Quản Lý</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
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
            $("#table-deliveries").DataTable({
                responsive: true, lengthChange: false, autoWidth: false,
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
                ajax: "{{route('admin.deliveries.getList')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'province', name: 'province'},
                    {data: 'district', name: 'district'},
                    {data: 'ward', name: 'ward'},
                    {data: 'fee', name: 'fee'},
                    {data: 'actions', name: 'actions'},
                ],
            }).buttons().container().appendTo('#table-deliveries_wrapper .col-md-6:eq(0)');

            //When click "Xóa"
            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var id = $(this).val();
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

                Swal.fire({
                    title: "Bạn có chắc muốn xóa ?", icon: "warning",
                    text: "Dữ liệu này sẽ bị xóa và không thể phục hồi :((",
                    showCancelButton: true,  showCancleButton: true,
                    confirmButtonText: "Đồng Ý", cancelButtonText: "Hủy",
                }).then((result) =>  {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{route('admin.deliveries.delete')}}",
                            data: {id: id},
                            success: function (response) {
                                if (response.status == '422' || response.status == '404') {
                                    Swal.fire({title: "Xóa thất bại !", text: response.msg, icon: "error"});
                                }
                                if (response.status == '200') {
                                    Swal.fire({title: "Xóa dữ liệu thành công !", icon: "succes"});

                                    $('#table-deliveries').DataTable().ajax.reload(null, false);
                                }
                            }
                        });
                    }else if (result.dismiss) {
                        Swal.fire({title: "Hủy xóa dữ liệu !", icon: "info"});
                    }
                });
            });
        });
    </script>
@stop









