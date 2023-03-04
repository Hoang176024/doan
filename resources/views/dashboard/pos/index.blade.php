<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Bootstrap-ecommerce by Vosidiy">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>TEAM 3 . POS</title>
    <link rel="icon" href="{{asset('image/AdminLTELogo.png')}}">
    <link href="{{asset('css/pos/bootstrap.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/pos/ui.css')}}" rel="stylesheet" type="text/css"/>
    <script src="https://kit.fontawesome.com/2818147cbc.js" crossorigin="anonymous"></script>
    <link href="{{asset('css/pos/OverlayScrollbars.css')}}" type="text/css" rel="stylesheet"/>

    <!-- Multi Select Drop Down 2-->
    <link rel="stylesheet" href="{{asset('css/plugins/select2/select2.min.css')}}">

    <!-- Toastr-->
    <link rel="stylesheet" href="{{asset('css/plugins/toastr/toastr.min.css')}}">


    <style>
        .bg-default, .btn-default {
            background-color: #f2f3f8;
        }

        .btn-error {
            color: #ef5f5f;
        }
    </style>
    <!-- custom style -->
</head>
<body>
<section class="header-main">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3">
                <div class="brand-wrap">
                    <img class="logo" src="{{asset('image/AdminLTELogo.png')}}">
                    <h2 class="logo-text">POS</h2>
                </div>
                <!-- brand-wrap.// -->
            </div>
            <div class="col-lg-6 col-sm-6">
                <form action="#" class="search-wrap">
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search"/>
                    </div>
                </form>
                <!-- search-wrap .end// -->
            </div>
            <!-- col.// -->
            <div class="col-lg-3 col-sm-6">
                <div class="widgets-wrap d-flex justify-content-end">
                    <div class="widget-header">
                        <a href="#" class="icontext">
                            <a href="{{route('admin.dashboard')}}"
                               class="btn btn-primary m-btn m-btn--icon m-btn--icon-only">
                                <i class="fa fa-home"></i>
                            </a>
                        </a>
                    </div>
                </div>
            </div>
            <!-- col.// -->
        </div>
        <!-- row.// -->
    </div>
    <!-- container.// -->
</section>

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content padding-y-sm bg-default ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 card padding-y-sm card">
                <div id="items">
                    <div class="row" id="list_products"></div>
                </div>
            </div>

            <div class="col-md-6">
                <form id="pos_form">
                    @csrf
                    <div class="card" id="cart">
                        <div>
                            <label for="customer_id">
                                <strong>Customer</strong><span style="color: red"> *</span>
                            </label>
                            <select name="customer_id" class="customer_id" id="customer_id" style="width: 250px;">
                                <option value="0">----Normal customer---</option>
                                @foreach($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <div class="shopping-cart-wrap">
                            <table class="table table-hover shopping-cart-wrap">
                                <thead class="text-muted">
                                <tr>
                                    <th scope="col" width="200">Product</th>
                                    <th scope="col" width="120">Price</th>
                                    <th scope="col" width="120">Quantity</th>
                                    <th scope="col" width="120">Discount</th>
                                    <th scope="col" width="120">Total</th>
                                    <th scope="col" class="text-right" width="200">Remove</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="box">
                        <div class="row">
                            <div class="col-md-7">
                                <label for="total_product_fee"><strong>Listed price</strong></label>
                            </div>
                            <div class="col-md-5">
                                <input type="number" readonly class="form-control" value="0" name="total_product_fee"
                                       id="total_product_fee">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-7">
                                <label for="tax_rate"><strong>Tax</strong> <span
                                        style="color: red"> *</span></label>
                            </div>
                            <div class="col-md-5">
                                <select name="tax_rate" class="form-control" id="tax_rate">
                                    @foreach($taxes as $tax)
                                        <option value="{{$tax->rate}}">{{$tax->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-7">
                                <label for="tax_fee"><strong>Tax fee</strong></label>
                            </div>
                            <div class="col-md-5">
                                <input type="number" readonly name="tax_fee" id="tax_fee" class="form-control"
                                       value="0">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-7">
                                <label for="discount_invoice"><strong>Discount</strong></label>
                            </div>
                            <div class="col-md-5">
                                <input type="number" name="discount_invoice" id="discount_invoice" class="form-control"
                                       value="0">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-7">
                                <label for="total"><strong>Total</strong></label>
                            </div>
                            <div class="col-md-5">
                                <input type="number" id="total" name="total" readonly class="form-control" value="0">
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-7">
                                <label for="payment"><strong>Payment method</strong> <span
                                        style="color: red"> *</span></label>
                            </div>
                            <div class="col-md-5">
                                <select name="payment" class="form-control" id="payment">
                                    <option value="0">---Option----</option>
                                    <option value="1">Cash</option>
                                    <option value="2">Bank transfer</option>
                                    <option value="3">Card</option>
                                </select>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="note"><strong>Note: </strong></label>
                            </div>
                            <div class="col-md-8">
                                <textarea name="note" class="form-control" id="note" rows="3"></textarea>
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-lg btn-block fa-pull-right"><i
                                        class="fa fa-shopping-bag"></i>
                                    Complete
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- container //  -->
</section>

<script src="{{asset('js/pos/jquery-2.0.0.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pos/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/pos/OverlayScrollbars.js')}}" type="text/javascript"></script>
<script src="{{asset('js/plugins/select2/select2.full.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('js/plugins/toastr/toastr.min.js')}}"></script>
<script>
    $(function () {
        //The passed argument has to be at least a empty object or a object with your desired options
        //$("body").overlayScrollbars({ });
        $("#items").height(950);
        $("#items").overlayScrollbars({
            overflowBehavior: {
                x: "hidden",
                y: "scroll"
            }
        });
        $("#cart").height(445);
        $("#cart").overlayScrollbars({});
    });
</script>
<script type="text/javascript">

    $(document).ready(function () {
        $(".customer_id").select2();
        fetch_products_data();

        function fetch_products_data(query = '') {
            $.ajax({
                url: "{{ route('admin.pos.search') }}",
                method: 'GET',
                data: {query: query},
                dataType: 'json',
                success: function (data) {
                    $('#list_products').html(data.product);
                }
            })
        }

        $(document).on('keyup', '#search', function () {
            var query = $(this).val();
            fetch_products_data(query);
        });

        var count = 0;
        $(document).on('click', '.add_to_cart', function () {
            count++;
            var productId = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();

            if (check_exists(count, productId) == true) {
                $.ajax({
                    url: "{{route('admin.pos.chooseProduct')}}",
                    method: "POST",
                    dataType: "JSON",
                    data: {productId: productId, _token: _token},
                    success: function (data) {
                        var html = '';
                        html += '<tr>';
                        html += '<td><h6 class="title text-truncate">' + data.product.name + '</h6><input type="hidden" ' +
                            'name="item_productId[]" id="item_productId-' + count + '"  value=' + productId + '></td>';
                        html += '<td><input style="width: 100px;color:blue;" type="number" class="form-control" ' +
                            'name="item_price[]" id="item_price-' + count + '" readonly value="' + data.product.price_out + '"></td>';
                        html += '<td class="text-center"><input type="number" style="width: 60px;color: blue;" ' +
                            'name="item_quantity[]" min="0" class="item_quantity" id="item_quantity-' + count + '" value="0">' +
                            '<input type="hidden" name="item_productWarehouse[]" id="item_productWarehouse-' + count + '" ' +
                            ' class="item_productWarehouse" value=' + data.product.quantity + '></td>';
                        html += '<td><input style="width: 120px;color:blue;" type="number" class="item_discount form-control" ' +
                            'name="item_discount[]" min="0" id="item_discount-' + count + '" value="0"></td>';
                        html += '<td><input style="width: 120px;color:blue;" type="number" class="form-control" readonly ' +
                            'name="item_subTotal[]" id="item_subTotal-' + count + '" value="0"></td>';
                        html += ' <td class="text-right"><button class="btn btn-outline-danger remove" name="remove"><i class="fa fa-trash"></i></button></td></tr>';
                        $('tbody').append(html);
                    }
                });
            }
        });

        $(document).on('click', '.remove', function () {
            $(this).closest('tr').remove();
            count = count - 1;
            calculate_fee_total_product(count);
            calculate_total(count);
        });

        $(document).on('blur', '.item_quantity', function () {
            calculate_fee_total_product(count);
            calculate_total(count);
        });

        $(document).on('blur', '.item_discount', function () {
            calculate_fee_total_product(count);
            calculate_total(count);
        });

        $(document).on('blur', '#discount_invoice', function () {
            calculate_total(count);
        });

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
            var discount_invoice = parseFloat($('#discount_invoice').val());
            for (k = 1; k <= count; k++) {
                var quantity = $('#item_quantity-' + k).val();
                if (quantity > 0) {
                    var price = $('#item_price-' + k).val();
                    var discount = $('#item_discount-' + k).val();
                    if (price > 0) {
                        var sub_total = (parseFloat(quantity) * parseFloat(price)) - parseFloat(discount);
                        $('#item_subTotal-' + k).val(sub_total);
                        total += sub_total;
                    }
                }
            }
            var tax_rate = parseFloat($('#tax_rate').val());
            tax_fee = Math.round(parseFloat((total) * (tax_rate / 100)));
            $('#total').val(total + tax_fee - discount_invoice);
        }

        $('#pos_form').on('submit', function (event) {
            event.preventDefault();
            var has_error = false;

            if (count == 0) {
                has_error = true;
                toastr.error('Chưa mua Sản Phẩm nào', 'Đã có lỗi !', {timeOut: 7000});
                return false;
            }

            $('.item_quantity').each(function () {
                if ($(this).val() == 0) {
                    has_error = true;
                    toastr.error('Số Lượng tại Sản Phẩm nào đó chưa nhập', 'Đã có lỗi !', {timeOut: 7000});
                    return false;
                }
            });

            for (x = 1; x <= count; x++) {
                if ($('#item_subTotal-' + x).val() < 0) {
                    has_error = true;
                    toastr.error('Tồn tại Sản Phẩm đang tính tiền âm', 'Đã có lỗi !', {timeOut: 7000});
                    return false;
                }

                if (parseFloat($('#item_quantity-' + x).val()) > parseFloat($('#item_productWarehouse-' + x).val())) {
                   has_error = true;
                    toastr.error('Sản phẩm tại hàng thứ ' + x + ' có số lượng lớn hơn trong kho', 'Đã có lỗi !', {timeOut: 7000});
                    return false;
                }
            }

            if (has_error == false) {
                if (($('#total').val() < 0)) {
                    has_error = true;
                    toastr.error('Đơn Hàng đang bị âm', 'Đã có lỗi !', {timeOut: 7000});
                    return false;
                }

                if (($('#payment').val() < 1)) {
                    has_error = true;
                    toastr.error('Chưa chọn hình thức thanh toán', 'Đã có lỗi !', {timeOut: 7000});
                    return false;
                }
            }

            if ((has_error == false)) {
                var form_data = $(this).serialize();
                var _token = $('input[name="_token"]').val();
                var customer_id = $('#customer_id').val();
                var note = $('#note').val();
                var payment = $('#payment').val();
                var tax_rate = $('#tax_rate').val();
                var tax_fee = $('#tax_fee').val();
                var total_price_product = $('#total_product_fee').val();
                var total_last = $('#total').val();
                var discount_invoice = $('#discount_invoice').val();
                $.ajax({
                    url: "{{route('admin.pos.createNewInvoices')}}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        form_data: form_data,
                        customer_id: customer_id,note: note, payment: payment,tax_rate: tax_rate,
                        tax_fee: tax_fee,total_price_product: total_price_product,
                        total_last: total_last,_token: _token,discount_invoice:discount_invoice
                    },
                    success: function (data) {
                        if (data.message === 'Success') {
                           toastr.success('Thanh Toán thành công', 'Thành Công!', {timeOut: 5000});
                        }
                        window.location.href = "{{route('admin.posInvoices.index')}}";
                    }
                });

            }
        });

        function check_exists(count, productId) {
            for (m = 1; m <= count; m++) {
                if (productId == ($('#item_productId-' + m).val())) {
                    toastr.error('Sản Phẩm này đã có trong Giỏ Hàng', 'Đã có lỗi !', {timeOut: 5000});
                    return false;
                }
            }
            return true;
        }
    });
</script>
</body>
</html>
