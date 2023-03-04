<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class QuotationController extends Controller
{
    public function index(Request $request){
        $data = Product::with('unit')->orderBy('id', 'DESC')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->editColumn('price_out', function ($row) {
                    return number_format($row->price_out) . ' VNĐ';
                })
                ->editColumn('unit_id', function ($row) {
                    return $row->unit? $row->unit->unit_name : 'Not available';
                })
                ->editColumn('sale', function ($row) {
                    if(($row->sale) == 0)
                        return '';
                    return $row->sale . ' %';
                })
                ->addColumn('price_sale', function ($row) {
                    $price_sale = ($row->price_out) - ($row->price_out)*($row->sale)/100;
                    if(($row->sale) == 0)
                        return '';
                    return number_format($price_sale) . ' VNĐ';
                })
                ->addColumn('action', function ($data) {
                    // $button = '<button type="button" name="edit" id="'.$data->id.'"
                    //     class="edit btn btn-primary btn-sm">Edit</button>';
                    $button = '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '"
                            class="edit btn btn-primary btn-sm"><i class="fa fa-plus"></i> Thêm KM</button>';
                    return $button;
                })
                ->make(true);
        }
        return view('dashboard.quotation.index');
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Product::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }


    public function update(Request $request, Product $product)
    {
        // $product = Product::findOrFail($id);
        $rules = array(
            'sale' => 'required|integer|max:95',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'sale'    =>  $request->sale,
        );

        Product::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);

    }
}
