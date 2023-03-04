@extends('dashboard.layouts.app')
@section('title', 'Sửa Hóa Đơn Bán Hàng')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa Hóa Đơn Bán Hàng</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang Chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.saleInvoices.index')}}">Hóa Đơn Bán
                                    Hàng</a></li>
                            <li class="breadcrumb-item active">Sửa</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                {{--Form edit new order purchase--}}
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Sửa Đơn Bán Hàng: <strong>{{$saleInvoice->code}}</strong></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="edit_purchase_form">
                            @csrf
                            {{--User Information and Delivery Fee--}}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="customer_id">Khách Hàng<span style="color: red"> *</span></label>
                                        <select name="customer_id" class="form-control show-address" id="customer_id"
                                                @if($saleInvoice->status != 1) readonly="true" @endif>
                                            <option value="">---------Chọn Khách Hàng---------</option>
                                            @foreach($customers as $customer)
                                                <option value="{{$customer->id}}"
                                                        @if($customer->id == $saleInvoice->customer->id) selected @endif>{{$customer->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="delivery_to">Địa Chỉ Giao Hàng<span
                                                style="color: red"> *</span></label>
                                        <input type="text" class="form-control" id="delivery_to" name="delivery_to"
                                               value="{{$saleInvoice->delivery_to}}"
                                               @if($saleInvoice->status != 1) readonly @endif>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 10px">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="province_id">Tỉnh/Thành Phố<span
                                                    style="color: red"> *</span></label>
                                            <select
                                                class="form-control choose  @error('province_id') is-invalid @enderror"
                                                id="province_id" name="province_id"
                                                @if($saleInvoice->status != 1) disabled @endif>
                                                <option value="">-----Chọn Tỉnh/Thành Phố-----</option>
                                                @foreach($provinces as $province)
                                                    <option value="{{$province->id}}">
                                                        {{$province->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="district_id">Quận/Huyện<span style="color: red">*</span></label>
                                            <select class="form-control choose" id="district_id" name="district_id"
                                                    @if($saleInvoice->status != 1) disabled @endif>
                                                <option value="">-----Chọn Quận/Huyện-----</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ward_id">Phường/Thị Trấn/Xã <span
                                                    style="color: red">*</span></label>
                                            <select class="form-control" id="ward_id" name="ward_id"
                                                    @if($saleInvoice->status != 1) disabled @endif>
                                                <option value="">-----Chọn Phường/Thị Trấn/Xã-----</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="delivery_fee">Phí Vận Chuyển <span
                                                    style="color: red">*</span></label>
                                            <input type="number" class="form-control" id="delivery_fee"
                                                   @if($saleInvoice->status != 1) readonly @endif
                                                   name="delivery_fee" value="{{$saleInvoice->delivery_fee}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--Information of Product--}}
                            <div class="row">
                                <div class="table-repsonsive">
                                    <table class="table table-bordered" id="item_table">
                                        <thead>
                                        <tr>
                                            <th width="25%">Sản Phẩm <span style="color: red">*</span></th>
                                            <th width="10%">Còn</th>
                                            <th width="20%">Giá Bán</th>
                                            <th>Số Lượng <span style="color: red">*</span></th>
                                            <th>Giảm Giá</th>
                                            <th>Thành Tiền</th>
                                            <th>
                                                <button type="button" name="add" class="btn btn-success btn-sm add"
                                                        @if($saleInvoice->status != 1) disabled @endif>
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i = 1 @endphp
                                        @foreach($saleInvoice->sale_invoice_details as $row)
                                            <tr>
                                                <td><select name="item_product[]" class="form-control item_product"
                                                            data-product_row="{{$i}}" id="item_product-{{$i}}"
                                                            @if($saleInvoice->status != 1) readonly="true" @endif>
                                                        <option value="">Chọn</option>
                                                        @foreach($products as $product)
                                                            @if($product->id == $row->products->id)
                                                                <option value="{{$row->products->id}}" selected>
                                                                    {{$row->products->name}}
                                                                </option>
                                                            @else
                                                                <option value="{{$product->id}}">{{$product->name}}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="number" name="item_productWarehouse[]"
                                                           value="{{$row->products->quantity}}"
                                                           class="form-control item_productWarehouse"
                                                           id=" item_productWarehouse-{{$i}}" readonly></td>
                                                <td><input type="number" name="item_price[]"
                                                           value="{{$row->price}}"
                                                           class="form-control item_price"
                                                           id="item_price-{{$i}}" readonly></td>
                                                <td><input type="number" name="item_quantity[]"
                                                           value="{{$row->buying_quantity}}"
                                                           class="form-control item_quantity"
                                                           data-quantity_row="{{$i}}"
                                                           id="item_quantity-{{$i}}"
                                                           @if($saleInvoice->status != 1) readonly @endif></td>
                                                <td><input type="number" name="item_discount[]"
                                                           class="form-control item_discount "
                                                           value="{{$row->discount}}"
                                                           id="item_discount-{{$i}}"
                                                           @if($saleInvoice->status != 1) readonly @endif></td>

                                                <td><input type="number" name="item_subTotal[]"
                                                           class="form-control item_subTotal"
                                                           data-subTotal_row="{{$i}}" value="{{$row->sub_total}}"
                                                           id="item_subTotal-{{$i}}" readonly></td>
                                                <td>
                                                    <button type="button" name="remove"
                                                            class="btn btn-danger btn-sm remove"
                                                            @if($saleInvoice->status != 1) disabled @endif>
                                                        <i class="fas fa-minus"></i></button>
                                                </td>
                                            </tr>
                                            @php $i = $i+1; @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2 offset-md-10">
                                    <div class="form-group">
                                        <label for="total_product_fee">Tiền Hàng</label>
                                        <input type="number" class="form-control" id="total_product_fee" readonly
                                               name="total_product_fee" value="{{$saleInvoice->total_price_product}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2 offset-md-10">
                                    <div class="form-group">
                                        <label for="discount_invoice">Chiết Khấu Đơn</label>
                                        <input type="number" class="form-control discount_invoice" id="discount_invoice"
                                               @if($saleInvoice->status != 1) readonly @endif
                                               name="discount_invoice" value="{{$saleInvoice->discount_invoice}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 offset-md-5">
                                    <div class="form-group">
                                        <label for="tax_rate">Áp Dụng Thuế <span style="color: red">*</span></label>
                                        <select name="tax_rate" id="tax_rate" class="form-control"
                                                @if($saleInvoice->status !=1) disabled @endif>
                                            @foreach($taxes as $tax)
                                                <option value="{{$tax->rate}}"
                                                        @if($saleInvoice->tax->rate == $tax->rate) selected @endif>{{$tax->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 offset-md-2">
                                    <div class="form-group">
                                        <label for="tax_fee">Tiền Thuế</label>
                                        <input type="number" class="form-control" id="tax_fee" name="tax_fee"
                                               value="{{$saleInvoice->tax_fee}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="payment">Hình Thức Thanh Toán <span
                                                style="color: red">*</span></label>
                                        <select name="payment" id="payment" class="form-control"
                                                @if($saleInvoice->status !=1) disabled @endif>
                                            <option value="">---------Chọn Hình Thức---------</option>
                                            <option value="1" @if($saleInvoice->payment == 1) selected @endif>Tiền Mặt
                                            </option>
                                            <option value="2" @if($saleInvoice->payment == 2) selected @endif>Chuyển
                                                Khoản
                                            </option>
                                            <option value="3" @if($saleInvoice->payment == 3) selected @endif>Thẻ
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 offset-md-2">
                                    <div class="form-group">
                                        <label for="status">Tình Trạng Đơn<span style="color: red"> *</span></label>
                                        <select name="status" id="status" class="form-control status">
                                            @if($saleInvoice->status == 1)
                                                <option value="1" @if($saleInvoice->status == 1) selected @endif>Đơn Mới
                                                </option>
                                                <option value="2">Đang Giao Hàng</option>
                                            @elseif($saleInvoice->status == 2)
                                                <option value="2" selected>Đang Giao Hàng</option>
                                                <option value="3"> Thành Công</option>
                                                <option value="4"> Thất Bại / Trả Lại</option>
                                            @elseif($saleInvoice->status == 3)
                                                <option value="3" selected> Thành Công</option>
                                                <option value="4">Thất Bại / Trả Lại</option>
                                            @elseif($saleInvoice->status == 4)
                                                <option value="4" selected> Thất Bại / Trả Lại</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 offset-md-2">
                                    <div class="form-group">
                                        <label for="total">Tổng Tiền</label>
                                        <input type="number" class="form-control" id="total" name="total"
                                               value="{{$saleInvoice->total_last}}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="note">Ghi Chú Đơn Hàng</label>
                                        <textarea type="text" class="form-control" id="note" name="note"
                                                  @if($saleInvoice->status !=1) readonly @endif
                                                  rows="3">{{$saleInvoice->note}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Sửa Đổi</button>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
@stop

@section('js')
    <script src="{{asset('js/plugins/select2/select2.full.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".item_product").select2();

            //When click select City, District, Town
            $('.choose').on('change', function () {
                var action = $(this).attr('id');
                var id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                if (action === 'province_id') {
                    result = 'district_id';
                } else if (action === 'district_id') {
                    result = 'ward_id';
                }

                $.ajax({
                    url: "{{route('admin.deliveries.selectDelivery')}}",
                    method: "POST",
                    data: {action: action, id: id, _token: _token},
                    success: function (data) {
                        $('#' + result).html(data);
                    }
                });
            });

            $('#ward_id').on('change', function () {
                var wardId = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('admin.deliveries.showFee')}}",
                    method: "POST",
                    data: {wardId: wardId, _token: _token},
                    success: function (data) {
                        $('#delivery_fee').val(data);
                        calculate_total(count);
                    }
                });
            });

            //Ajax show address of Customer
            $('.show-address').on('change', function () {
                var customerId = $(this).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{route('admin.saleInvoices.showAddress')}}",
                    method: "POST",
                    data: {customerId: customerId, _token: _token},
                    success: function (data) {
                        $('#delivery_to').val(data);
                    }
                });
            });

            var count = {{$count}};
            var products = @json($products);
            var saleInvoiceStatus = {{$saleInvoiceStatus}};
            $(document).on('click', '.add', function () {
                count++;
                var html = '<tr><td><select name="item_product[]" id="item_product-' + count + '" class="form-control item_product"' +
                    'data-product_row="' + count + '">';
                html += '<option value="0">---Chọn Sản Phẩm---</option>';
                for (var i = 0; i < products.length; i++) {
                    html += '<option value="' + products[i].id + '">' + products[i].name + '</option>';
                }
                html += '</select></td>';

                html += '<td><input type="number" name="item_productWarehouse[]" class="form-control item_productWarehouse" id="item_productWarehouse-' + count + '" readonly></td>';
                html += '<td><input type="number" name="item_price[]" class="form-control item_price" id="item_price-' + count + '" readonly></td>';
                html += '<td><input type="number" name="item_quantity[]" value="0" class="form-control item_quantity" data-quantity_row="' + count + '" id="item_quantity-' + count + '" /></td>';
                html += '<td><input type="number" name="item_discount[]" class="form-control item_discount" id="item_discount-' + count + '" value="0"></td>';
                html += '<td><input type="number" name="item_subTotal[]" class="form-control item_subTotal" data-subTotal_row="' + count + '" id="item_subTotal-' + count + '"  readonly></td>';
                html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button></td>';
                $('tbody').append(html);
                $(".item_product").select2();
            });

            $(document).on('click', '.remove', function () {
                if (saleInvoiceStatus == 1) {
                    $(this).closest('tr').remove();
                    count = count - 1;
                    calculate_fee_total_product(count);
                    calculate_total(count);
                }
            });

            $(document).on('change', '.item_product', function () {
                var productId = $(this).val();
                var product_row = $(this).data('product_row');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{route('admin.saleInvoices.showPrice')}}",
                    method: "POST",
                    dataType: "JSON",
                    data: {productId: productId, _token: _token},
                    success: function (result) {
                        $('#item_price-' + product_row).val(result.product.price_out);
                        $('#item_productWarehouse-' + product_row).val(result.product.quantity);
                    }
                })
            });

            $('#delivery_fee').on('change', function () {
                calculate_total(count);
            })

            $('#tax_rate').on('change', function () {
                var tax_rate = $(this).val();
                var total_product_fee = parseFloat($('#total_product_fee').val());
                var tax_fee = total_product_fee * (parseFloat(tax_rate / 100));
                $('#tax_fee').val(Math.round(tax_fee));
                calculate_total(count);
            });

            function calculate_fee_total_product(count) {
                var total_fee_product = 0;
                for (j = 1; j <= count; j++) {
                    var quantity = $('#item_quantity-' + j).val();
                    if (quantity > 0) {
                        var price = $('#item_price-' + j).val();
                        var discount = $('#item_discount-' + j).val();
                        if (price > 0) {
                            var sub_total = (parseFloat(quantity) * parseFloat(price)) - parseFloat(discount);
                            $('#item_subTotal-' + j).val(sub_total);
                            total_fee_product += sub_total;
                        }
                    }
                }
                $('#total_product_fee').val(total_fee_product);
                var tax_rate = $('#tax_rate').val();
                var tax_fee = parseFloat((total_fee_product) * (tax_rate / 100));
                $('#tax_fee').val(Math.round(tax_fee));
            }

            function calculate_total(count) {
                var total = 0;
                var delivery_fee = parseFloat($('#delivery_fee').val());
                var discount_invoice = parseFloat($('#discount_invoice').val());
                for (j = 1; j <= count; j++) {
                    var quantity = $('#item_quantity-' + j).val();
                    if (quantity > 0) {
                        var price = $('#item_price-' + j).val();
                        var discount = $('#item_discount-' + j).val();
                        if (price > 0) {
                            var sub_total = (parseFloat(quantity) * parseFloat(price)) - parseFloat(discount);
                            $('#item_subTotal-' + j).val(sub_total);
                            total += sub_total;
                        }
                    }
                }
                var tax_rate = parseFloat($('#tax_rate').val());
                tax_fee = Math.round(parseFloat((total) * (tax_rate / 100)));
                $('#total').val(total + delivery_fee + tax_fee - discount_invoice);
            }

            $(document).on('blur', '.item_quantity', function () {
                calculate_fee_total_product(count);
                calculate_total(count);
            });

            $(document).on('blur', '.item_discount', function () {
                calculate_fee_total_product(count);
                calculate_total(count);
            });

            $(document).on('blur', '.discount_invoice', function () {
                calculate_total(count);
            });

            $('#edit_purchase_form').on('submit', function (event) {
                event.preventDefault();
                var has_error = false;
                if ($('#delivery_to').val() == null || $('#delivery_to').val() == '') {
                    has_error = true;
                    toastr.error('Chưa có địa chỉ giao hàng', 'Đã có lỗi !', {timeOut: 5000});
                    return false;
                }

                $('.item_product').each(function () {
                    if ($(this).val() == 0) {
                        has_error = true;
                        toastr.error('Sản Phẩm tại hàng nào đó chưa nhập', 'Đã có lỗi !', {timeOut: 7000});
                        return false;
                    }
                });

                $('.item_quantity').each(function () {
                    if ($(this).val() == 0) {
                        has_error = true;
                        toastr.error('Số Lượng tại hàng nào đó chưa nhập', 'Đã có lỗi !', {timeOut: 7000});
                        return false;
                    }
                });

                if (has_error == false) {
                    for (k = 1; k <= count; k++) {
                        if (parseFloat($('#item_subTotal-' + k).val()) < 0) {
                            has_error = true;
                            toastr.error('Tồn tại Sản Phẩm đang tính tiền âm', 'Đã có lỗi !', {timeOut: 7000});
                            return false;
                        }

                        if (parseFloat($('#item_quantity-' + k).val()) > parseFloat($('#item_productWarehouse-' + k).val())) {
                            has_error = true;
                            toastr.error('Sản phẩm tại hàng thứ ' + k + ' có số lượng lớn hơn trong kho', 'Đã có lỗi !', {timeOut: 7000});
                            return false;
                        }
                    }
                    if (parseFloat($('#total').val() < 0)) {
                        has_error = true;
                        toastr.error('Đơn Hàng đang bị âm', 'Đã có lỗi !', {timeOut: 7000});
                        return false;
                    }

                    if (($('#payment').val() < 1) && ($('#total').val() != 0)) {
                        has_error = true;
                        toastr.error('Chưa chọn hình thức thanh toán', 'Đã có lỗi !', {timeOut: 7000});
                        return false;
                    }
                    if ($('#item_product-1').val() == 0 || $('#item_product-1').val() == null) {
                        has_error = true;
                        toastr.error('Chưa có dữ liệu Đơn Hàng', 'Đã có lỗi !', {timeOut: 7000});
                        return false;
                    }
                }

                if ((has_error == false)) {
                    var form_data = $(this).serialize();
                    var _token = $('input[name="_token"]').val();
                    var customer_id = $('#customer_id').val();
                    var delivery_to = $('#delivery_to').val();
                    var delivery_fee = $('#delivery_fee').val();
                    var note = $('#note').val();
                    var payment = $('#payment').val();
                    var status = $('#status').val();
                    var tax_rate = $('#tax_rate').val();
                    var tax_fee = $('#tax_fee').val();
                    var total_price_product = $('#total_product_fee').val();
                    var discount_invoice = $('#discount_invoice').val();
                    var total_last = $('#total').val();
                    $.ajax({
                        url: "{{route('admin.saleInvoices.update', $saleInvoice->id)}}",
                        method: "POST",
                        dataType: "JSON",
                        data: {
                            form_data: form_data,
                            customer_id: customer_id, delivery_to: delivery_to, delivery_fee: delivery_fee,
                            note: note, payment: payment, status: status, tax_rate: tax_rate, tax_fee: tax_fee,
                            total_price_product: total_price_product, total_last: total_last,
                            discount_invoice: discount_invoice, _token: _token,
                        },
                        success: function (data) {}
                    });
                    toastr.success('Cập Nhật Hóa Đơn Bán Hàng thành công', 'Thành Công!', {timeOut: 4000});
                    window.location.href = "{{route('admin.saleInvoices.index')}}";
                }
            });
        });

    </script>
@stop


