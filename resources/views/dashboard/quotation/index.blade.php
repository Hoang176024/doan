@extends('dashboard.layouts.app')
@section('title', 'Quotations')
@section('css')

    <link rel="stylesheet" href="{{asset('css/plugins/datatables/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/datatables/responsive.bootstrap4.min.css')}}">

@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bảng giá</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Quotation</li>
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
                        <div class="card-header" style="height: 60px;display: flex;">
                            <h3 class="card-title" style="margin-top: 5px;">Bảng giá Sản phẩm</h3>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="quotations-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên SP</th>
                                        <th>Giá</th>
                                        <th>Đơn vị</th>
                                        <th>Khuyến mại</th>
                                        {{-- <th>Hạn KM</th> --}}
                                        <th>Giá KM</th>
                                        <th>Tác vụ</th>
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

@section('modal')
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm Khuyến mại!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        </div>

        <div class="modal-body">
            <span id="form_result"></span>
            <form method="post" id="sample_form" class="form-horizontal">
            @csrf
                <div class="form-group">
                    <label class="control-label col-md-4">Khuyến mại</label>
                    <input type="text" name="sale" id="sale" class="form-control" placeholder="Enter sale rate...">
                </div>
                <br />
                <div class="form-group" align="center">
                    <input type="hidden" name="action" id="action" value="Edit" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="Thêm" />
                </div>
            </form>
        </div>

        {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div> --}}
      </div>
    </div>
  </div>
@endsection

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


<script type=text/javascript>
    $(document).ready(function(){
        
        $('#quotations-table').DataTable({
            lengthChange: false, 
            autoWidth: false,
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
            ajax:{
            url:"{{ route('admin.quotations.index') }}",
        	},
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' , orderable: false},
                { data: 'price_out', name: 'price_out' , orderable: false},
                { data: 'unit_id', name: 'unit_id', orderable: false },
                { data: 'sale', name: 'sale', orderable: false },
                { data: 'price_sale', name: 'price_sale', orderable: false },
                { data: 'action', name: 'action', orderable: false }
            ]
        }).buttons().container().appendTo('#customers-table_wrapper .col-md-6:eq(0)');
        
        // Modal Edit ###########################################
        // var table = $('#quotations-table').DataTable();

        // Start edit
        $('#sample_form').on('submit', function(event){
            event.preventDefault();
            var action_url = "{{ route('admin.quotations.edit.update') }}";

            $.ajax({
                url: action_url,
                method:"PUT",
                data:$(this).serialize(),
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    if(data.errors){
                        html = '<div class="alert alert-danger">';
                        for(var count = 0; count < data.errors.length; count++){
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if(data.success){
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        $('#quotations-table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                }
            });
        });

        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url :"/quotations/edit/"+id,
                dataType:"json",
                success:function(data)
                {
                    $('#sale').val(data.result.sale);
                    $('#hidden_id').val(id);
                    // $('.modal-title').text('Edit Record');
                    // $('#action_button').val('Edit');
                    $('#action').val('Edit');
                    
                    $('#editModal').modal('show');
                    $("#action_button").click(function(){
                        // $("#sale").hide();
                        // $("#action_button").hide();
                        setTimeout(function(){
                            $("#editModal").modal('hide');
                        }, 2000);
                    });
                }
            })
        })
    });

</script>
@stop

