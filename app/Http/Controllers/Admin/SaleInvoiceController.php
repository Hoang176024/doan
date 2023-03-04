<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Tax;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SaleInvoice;
use App\Models\SaleInvoiceDetail;
use App\Models\Supplier;
use Carbon\Carbon;
use HoangPhi\VietnamMap\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class SaleInvoiceController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.sale_invoices.index');
    }

    public function getList()
    {
        $saleInvoices = SaleInvoice::with('user', 'customer', 'tax')
            ->orderBy('id', 'DESC')->get();
        return DataTables::of($saleInvoices)->addIndexColumn()
            ->addColumn('status', function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge badge-primary">Đơn Mới</span>';
                } else {
                    if ($row->status == 2) {
                        return '<span class="badge badge-warning">Đang Giao</span>';
                    } else {
                        if ($row->status == 3) {
                            return '<span class="badge badge-success">Thành Công</span>';
                        } else {
                            if ($row->status == 4) {
                                return '<span class="badge badge-danger">Thất Bại</span>';
                            }
                        }
                    }
                }
            })
            ->addColumn('payment', function ($row) {
                if ($row->payment == 1) {
                    return '<span class="badge badge-primary">Tiền Mặt</span>';
                } else {
                    if ($row->payment == 2) {
                        return '<span class="badge badge-success">Chuyển Khoản</span>';
                    } else {
                        if ($row->payment == 3) {
                            return '<span class="badge badge-danger">Thẻ</span>';
                        }
                    }
                }
            })
            ->addColumn('customer_id', function ($row) {
                return $row->customer->name;
            })
            ->addColumn('tax_id', function ($row) {
                return $row->tax->name;
            })
            ->addColumn('total_price_product', function ($row) {
                return number_format($row->total_price_product, 0)." VNĐ";
            })
            ->addColumn('delivery_fee', function ($row) {
                return number_format($row->delivery_fee, 0) . " VNĐ";
            })
            ->addColumn('tax_fee', function ($row) {
                return number_format($row->tax_fee, 0) . " VNĐ";
            })
            ->addColumn('discount_invoice', function ($row) {
                return number_format($row->discount_invoice, 0) . " VNĐ";
            })
            ->addColumn('total_last', function ($row) {
                return number_format($row->total_last, 0) . " VNĐ";
            })
            ->addColumn('user_id', function ($row) {
                return $row->user->full_name;
            })
            ->addColumn('created_at', function ($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                        <button class="btn_detail btn btn-info" value="' . $row->id . '"><i class="fas fa-eye"></i></button>
                        <a href="' . route('admin.saleInvoices.edit', $row->id) . '">
                        <button class="role_btn btn btn-warning" value="' . $row->id . '"><i class="fas fa-pencil-alt"></i></button></a>
                        <button class="delete_btn btn btn-danger" value="' . $row->id . '"><i class="fas fa-trash-alt"></i></button>
                    </div>';
            })->rawColumns(['status', 'payment', 'actions'])->make(true);
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        $suppliers = Supplier::all();
        $provinces = Province::all();
        $taxes = Tax::all();
        return view('dashboard.admin.sale_invoices.create')->with(compact('customers',
            'products', 'suppliers', 'provinces', 'taxes'));
    }

    public function edit($saleInvoiceId){
        $customers = Customer::all();
        $products = Product::all();
        $provinces = Province::all();
        $taxes = Tax::all();
        $saleInvoice = SaleInvoice::with('sale_invoice_details', 'user', 'tax', 'customer')->find($saleInvoiceId);
        $saleInvoiceStatus = $saleInvoice->status;
        $count = count($saleInvoice->sale_invoice_details);
        return view('dashboard.admin.sale_invoices.edit')->with(compact('saleInvoice', 'customers',
            'count', 'products',  'provinces',  'taxes', 'saleInvoiceStatus'));
    }

    public function showAddress(Request $request)
    {
        $customer = Customer::find($request->customerId);
        if ($customer) {
            return $customer->address;
        } else {
            return null;
        }
    }

    public function showPrice(Request $request)
    {
        $product = Product::find($request->productId);
        if ($product) {
            $result = array('product' => $product);
            return json_encode($result);
        } else {
            return null;
        }
    }

    public function store(Request $request)
    {
        $tax = Tax::where('rate', $request->tax_rate)->first();
        $dataSaleInvoice['code'] = "SALE-" . Carbon::now('Asia/Ho_Chi_Minh')->rawFormat('dmy-hi');
        $dataSaleInvoice['user_id'] = Auth::user()->id;
        $dataSaleInvoice['customer_id'] = $request->customer_id;
        $dataSaleInvoice['delivery_to'] = $request->delivery_to;
        $dataSaleInvoice['delivery_fee'] = $request->delivery_fee;
        $dataSaleInvoice['note'] = $request->note;
        $dataSaleInvoice['payment'] = $request->payment;
        $dataSaleInvoice['status'] = $request->status;
        $dataSaleInvoice['tax_id'] = $tax->id;
        $dataSaleInvoice['tax_fee'] = $request->tax_fee;
        $dataSaleInvoice['total_price_product'] = $request->total_price_product;
        $dataSaleInvoice['discount_invoice'] = $request->discount_invoice;
        $dataSaleInvoice['total_last'] = $request->total_last;
        $saleInvoice = SaleInvoice::create($dataSaleInvoice);

        parse_str($_POST['form_data'], $data);//parse string of $_POST['form_data'] to $data
        for ($count = 0; $count < count($data['item_product']); $count++) {
            $dataDetail = array(
                'sale_invoice_id' => $saleInvoice->id,
                'product_id' => $data['item_product'][$count],
                'buying_quantity' => $data['item_quantity'][$count],
                'price' => $data['item_price'][$count],
                'discount' => $data['item_discount'][$count],
                'sub_total' => $data['item_subTotal'][$count],
            );

            if($request->status == 2){//Sub product quantity
                $product = Product::find($data['item_product'][$count]);
                $product->quantity -= $data['item_quantity'][$count];
                $product->save();
            }

            $saleInvoiceDetail = SaleInvoiceDetail::create($dataDetail);
        }
        return 'Success';
    }

    public function update(Request $request, $saleInvoiceId){
        $tax = Tax::where('rate', $request->tax_rate)->first();
        $saleInvoice = SaleInvoice::with('sale_invoice_details', 'user', 'tax', 'customer')->find($saleInvoiceId);
        if(($request->status == 1) || ($request->status == 2)){
            $saleInvoice->user_id = Auth::user()->id;
            $saleInvoice->customer_id = $request->customer_id;
            $saleInvoice->delivery_to = $request->delivery_to;
            $saleInvoice->delivery_fee = $request->delivery_fee;
            $saleInvoice->note = $request->note;
            $saleInvoice->payment = $request->payment;
            $saleInvoice->status = $request->status;
            $saleInvoice->tax_id = $tax->id;
            $saleInvoice->tax_fee = $request->tax_fee;
            $saleInvoice->total_price_product = $request->total_price_product;
            $saleInvoice->discount_invoice = $request->total_price_product;
            $saleInvoice->total_last = $request->total_last;
            $saleInvoice->save();

            //Delete all Sale Invoice detail old
            SaleInvoiceDetail::where('sale_invoice_id', $saleInvoiceId)->delete();

            //Update new Sale Invoice order detail
            parse_str($_POST['form_data'], $data);//parse string of $_POST['form_data'] to $data
            for ($count = 0; $count < count($data['item_product']); $count++) {
                $dataDetail = array(
                    'sale_invoice_id' => $saleInvoice->id,
                    'product_id' => $data['item_product'][$count],
                    'buying_quantity' => $data['item_quantity'][$count],
                    'price' => $data['item_price'][$count],
                    'discount' => $data['item_discount'][$count],
                    'sub_total' => $data['item_subTotal'][$count],
                );

                if($request->status == 2){//Sub product quantity
                    $product = Product::find($data['item_product'][$count]);
                    $product->quantity -= $data['item_quantity'][$count];
                    $product->save();
                }
                $saleInvoiceDetail = SaleInvoiceDetail::create($dataDetail);
            }
            return 'Success';
        }else if(($request->status == 3)){
            $saleInvoice->status = $request->status;
            $saleInvoice->save();
            return 'Success';
        } else if(($request->status == 4)){//Re add product quantity
            $saleInvoice->status = $request->status;
            $saleInvoice->save();
            parse_str($_POST['form_data'], $data);//parse string of $_POST['form_data'] to $data
            for ($count = 0; $count < count($data['item_product']); $count++) {
                $product = Product::find($data['item_product'][$count]);
                $product->quantity += $data['item_quantity'][$count];
                $product->save();
            }
            return 'Success';
        }
    }

    public function detail(Request $request)
    {
        $saleInvoice = SaleInvoice::with('user', 'customer', 'tax', 'sale_invoice_details')
            ->find($request->saleInvoiceId);
        $output = '<div class="col-md-6">
             <p><strong>Mã Đơn Hàng: </strong>' . $saleInvoice->code . '</p>
             <p><strong>Người Tạo: </strong>' . $saleInvoice->user->full_name . '</p>
             <p><strong>Vai Trò: </strong>' . ($saleInvoice->user->getRoleNames())[0] . '</p>
             <p><strong>Ngày Tạo: </strong>' . $saleInvoice->updated_at->format('d/m/y') . '</p></div>
             <div class="col-md-6">
             <p><strong>Khách Hàng: </strong>' . $saleInvoice->customer->name . '</p>
             <p><strong>Ghi Chú: </strong>' . $saleInvoice->note . '</p>
             <p><strong>Thanh Toán: </strong>' . $saleInvoice->getPayment() . '</p></div>
             <p style="margin-left: 10px"><strong>Giao Đến: </strong>' . $saleInvoice->delivery_to .'</p>';

        $output .= '<table class="table table-bordered table-striped"><thead><tr><th>STT</th><th>Sản Phẩm</th>
           <th>Giá</th><th>Số Lượng</th><th>Giảm Giá</th><th>Thành Tiền</th></tr></thead><tbody>';
        $count = 1;
        foreach ($saleInvoice->sale_invoice_details as $row) {
            $output .= '<tr><td>' . $count . '</td>';
            $output .= '<td>' . $row->products->name . '</td>';
            $output .= '<td>' . number_format($row->price, 0) . ' VNĐ' . '</td>';
            $output .= '<td>' . $row->buying_quantity . '</td>';
            $output .= '<td>' . number_format($row->discount, 0) . '</td>';
            $output .= '<td>' . number_format($row->sub_total, 0) . ' VNĐ' . '</td></tr>';
            $count++;
        }
        $output .=
            '<tr><td colspan="4"></td><td><strong>Tiền Hàng<td>'
            . number_format($saleInvoice->total_price_product, 0) . ' VNĐ' . '</td></tr>
            <tr><td colspan="4"></td><td><strong>Thuế</strong> (' . $saleInvoice->tax->name . ')</td><td>'
            . number_format($saleInvoice->tax_fee, 0) . ' VNĐ' . '</td></tr>
            <tr><td colspan="4"></td><td><strong>Phí Ship<td>'
            . number_format($saleInvoice->delivery_fee, 0) . ' VNĐ' . '</td></tr>
             <tr><td colspan="4"></td><td><strong>Chiết Khấu Đơn<td>'
            . number_format($saleInvoice->discount_invoice, 0) . ' VNĐ' . '</td></tr>
            <tr><td colspan="4"></td><td><strong>Tổng Tiền</strong></td><td>'
            . number_format($saleInvoice->total_last, 0) . ' VNĐ' . '</td></tr>';
        return $output;
    }

    public function convertToPDF($saleInvoiceId)
    {
        $saleInvoice = SaleInvoice::with('user', 'customer', 'tax', 'sale_invoice_details')
            ->find($saleInvoiceId);;
        $output =
            '<style>
                body{ font-family: "DejaVu Sans;",sans-serif;}
                table {border-collapse: collapse;}
                table, td, th{ border: 1px solid black;border-spacing: 0;}
                h3, td, th{ text-align: center;}
             </style>
            <h3 style="text-align: center;">Hóa Đơn Bán Hàng</h3>
            <p>
                <strong>Mã Hóa Đơn: </strong>' . $saleInvoice->code . '
                <strong style="margin-left: 100px">Khách Hàng: </strong>' . $saleInvoice->customer->name . '
            </p>
            <p>
                <strong>Ngày Tạo: </strong>' . $saleInvoice->created_at->format('d/m/y') . '
                <strong style="margin-left: 205px">Thanh Toán: </strong>' . $saleInvoice->getPayment() . '
            </p>
            <p><strong>Giao Đến: </strong>' . $saleInvoice->delivery_to . '</p>
            <p><strong>Thuế: </strong>' . $saleInvoice->tax->name . '</p>
            <p><strong>Ghi Chú: </strong>' . $saleInvoice->note . '</p>
             <p><strong>Người Tạo: </strong>' . $saleInvoice->user->full_name . '</p>
            <table style="width: 100%; text-align: center;" id="table_1"><thead><tr>
                <th>STT</th><th>Sản Phẩm</th><th>Giá</th><th>Số Lượng</th>
                <th>Giảm Giá</th><th>Thành Tiền</th>
            </tr></thead><tbody>';
        $count = 1;
        foreach ($saleInvoice->sale_invoice_details as $row) {
            $output .= '<tr><td>' . $count . '</td>';
            $output .= '<td>' . $row->products->name . '</td>';
            $output .= '<td>' . number_format($row->price, 0, ',') . ' VNĐ' . '</td>';
            $output .= '<td>' . $row->buying_quantity . '</td>';
            $output .= '<td>' . number_format($row->discount, 0, ',') . '</td>';
            $output .= '<td>' . number_format($row->sub_total, 0, ',') . ' VNĐ' . '</td></tr>';
            $count++;
        }
        $output .= '</tbody></table>';
        $output .=
            '<p style="margin-top: 50px"><strong  style="margin-left: 300px">Tiền Hàng</strong>
            <span style="margin-left: 170px">' . number_format($saleInvoice->total_product_price, 0, ',') . ' VNĐ</span></p>
            <p><strong style="margin-left: 300px">Tiền Thuế</strong>
            <span style="margin-left: 168px">' . number_format($saleInvoice->tax_fee, 0, ',') . ' VNĐ' . '</span></p>
            <p><strong  style="margin-left: 300px">Phí Ship</strong>
            <span style="margin-left: 185px">' . number_format($saleInvoice->delivery_fee, 0, ',') . ' VNĐ' . '</span></p>
            <p><strong  style="margin-left: 300px">Chiết Khấu Đơn</strong>
            <span style="margin-left: 120px">' . number_format($saleInvoice->discount_invoice, 0, ',') . ' VNĐ' . '</span></p>
            <p><strong  style="margin-left: 300px">Tổng Tiền</strong>
            <span style="margin-left: 170px">' . number_format($saleInvoice->total_last, 0, ',') . ' VNĐ</span></p>';
        return $output;
    }

    public function printPDF($saleInvoiceId)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convertToPDF($saleInvoiceId));
        return $pdf->stream();
    }

    public function delete(Request $request)
    {
        $saleInvoice = SaleInvoice::with('user', 'customer', 'tax', 'sale_invoice_details')
            ->find($request->saleInvoiceId);;
        if ($saleInvoice) {
            DB::beginTransaction();
            try {
                //Delete all Sale Invoice Detail then delete Sale Invoice
                SaleInvoiceDetail::where('sale_invoice_id', $request->saleInvoiceId)->delete();
                $saleInvoice->delete();
            } catch (\Throwable $e) {
                DB::rollBack();
                Log::error($e->getMessage(), [$e->getTraceAsString()]);
                return response()->json(['status' => 422, 'msg' => 'Có lỗi khi xóa']);
            }
            DB::commit();
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 404, 'msg' => 'Không tìm thấy dữ liệu']);
        }
    }
}
