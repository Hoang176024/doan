<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin\Tax;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PosController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'DESC')->get();
        $taxes = Tax::orderBy('id', 'DESC')->get();
        return view('dashboard.pos.index')->with(compact('customers', 'taxes'));
    }

    public function search(Request $request)
    {
        $output = '';
        if ($request->ajax()) {
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('products')
                    ->where('name', 'like', '%' . $query . '%')
                    ->orWhere('barcode', 'like', '%' . $query . '%')
                    ->get();
            } else {
                $data = DB::table('products')->orderBy('id', 'DESC')
                    ->paginate(20);
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $product) {
                    $output .= '
                            <div class="col-md-3" style="height: 370px; display: flex">
                                <figure class="card card-product">
                                    <div class="img-wrap">
                                        <img src="'.($product->photo ? Storage::url($product->photo) : asset('image/no_img.png') ).'">
                                    </div>
                                    <figcaption class="info-wrap">
                                        <p style="color: blue">'.$product->name.'</p>
                                        <p style="color: green">Left:'. $product->quantity .'</p>
                                        <p style="color: red">'.number_format($product->price_out, 0, ',') . ' VNĐ</p>
                                        <button class="btn btn-primary btn-md add_to_cart" data-product_id="'.$product->id.'">
                                               <i class="fa fa-cart-plus"></i> Pick
                                        </button>
                                    </figcaption>
                                </figure>
                           </div>';
                }
            }else {
                $output = '  <div><h3 style="color:red; margin-left: 220px;" >This product is not available</h3></div> ';
            }

            $data = array( 'product' => $output);
            echo json_encode($data);
        }
    }

    public function chooseProduct(Request $request){
        $product = Product::find($request->productId);
        $data = array('product'=>$product);
        return json_encode($data);
    }

}
