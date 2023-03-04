<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Imports\ProductImport;
use App\Models\Admin\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Milon\Barcode\DNS1D;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.products.index');
    }

    public function getList()
    {
        $products = Product::with('category', 'unit', 'supplier', 'brand')->orderBy('id', 'DESC')->get()
        ->map(function ($product) {
            $product->photo_url = $product->photo ? Storage::url($product->photo) : asset('image/no_img.png');
            return $product;});
        return DataTables::of($products)->addIndexColumn()
            ->addColumn('brand_id', function ($row) {
                return $row->brand ? $row->brand->name : 'Not available';
            })->rawColumns(['brand_id'])
            ->addColumn('price_in', function ($row) {
                return number_format($row->price_in) . ' VNĐ';
            })->rawColumns(['price_in'])
            ->addColumn('price_out', function ($row) {
                return number_format($row->price_out) . ' VNĐ';
            })->rawColumns(['price_out'])
            ->addColumn('unit_id', function ($row) {
                return $row->unit ? $row->unit->unit_name : 'Not available';
            })->rawColumns(['unit_id'])
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                        <button class="btn_detail btn btn-info" value="' . $row->id . '"><i class="fas fa-eye"></i></button>
                        <a href="' . route('admin.products.edit', $row->id) . '">
                        <button class="role_btn btn btn-warning" value="' . $row->id . '"><i class="fas fa-pencil-alt"></i></button></a>
                        <button class="delete_btn btn btn-danger" value="' . $row->id . '"><i class="fas fa-trash-alt"></i></button>
                    </div>';
            })->rawColumns(['actions'])->make(true);
    }

    public function detail(Request $request)
    {
        $product = Product::with('category', 'unit', 'supplier', 'brand')->where('id',
            $request->productId)->first();
        if ($product->photo != null) {
            $image = '<img src="' . Storage::url($product->photo) . '" width="100%" height="200px"/>';
        } else {
            $image = '<img src="' . asset('image/no_img.png') . '" width="100%" height="200px"/>';
        }

        $barcode = (new  DNS1D)->getBarcodeHTML($product->barcode, 'C128');

        $output =
            '<div class="col-md-4">
               <div class="row">' . $image . '</div>
               <div class="row" style="margin-top:20px">' . $barcode . '</div>
               <div class="row"><p style="width: 100%; text-align: center">' . $product->barcode . '</p></div>
            </div>
            <div class="col-md-8">
                <table style="width: 100%">
                    <tr><th>Name:</th><td>' . $product->name . '</td></tr>
                    <tr><th>Brand: </th> <td >' . ($product->brand ? $product->brand->name : 'Not available') . '</td></tr>
                    <tr><th>Category: </th><td >' . ($product->category ? $product->category->name : 'Not available'). '</td></tr>
                    <tr><th>Unit: </th><td>' . ($product->unit ? $product->unit->unit_name : 'Not available') . '</td></tr>
                    <tr><th>Quantity: </th> <td >' . $product->quantity . '</td></tr>
                    
                    <tr>
                        <th>Purchased price: </th>
                        <td >' . number_format($product->price_in, 0, ',') . ' VNĐ' . '</td>
                    </tr>
                    <tr style="width: 100%">
                        <th>Selling price: </th>
                        <td >' . number_format($product->price_out, 0, ',') . ' VNĐ' . '</td>
                    </tr>
                    <tr><th>Supplier: </th><td>' .( $product->supplier ? $product->supplier->name : 'Not available' ). '</td></tr>
                    <tr><th>Description: </th><td>' . $product->description . '</td></tr>

                    <tr><th>Date of manufacture: </th><td>' . (($product->mfg != null) ? date('d-m-Y',
                strtotime($product->mfg)) : '') . '</td></tr>
                    <tr><th>Expiry: </th><td>' . (($product->exp != null) ? date('d-m-Y',
                strtotime($product->exp)) : '') . '</td></tr>
                </table>
            </div> ';
        $barcode = '';
        return $output;
    }

    public function create()
    {
        $units = Unit::get();
        $brands = Brand::get();
        $categories = Category::get();
        $suppliers = Supplier::get();
        return view('dashboard.admin.products.create', compact(
            'categories', 'brands', 'units', 'suppliers'));
    }

    public function store(ProductRequest $request)
    {
        $request->validated();
        $data = $request->except('_token');
        $data = array_filter($data, 'strlen');
        $path = $this->_upload($request);
        if ($path) {
            $data['photo'] = $path;
        }
        $data['name'] = $request->input('name');
        $data['price_in'] = $request->input('price_in');
        $data['price_out'] = $request->input('price_out');
        $data['quantity'] = $request->input('quantity');
        $data['quantity_alert'] = $request->input('quantity_alert') ?? null;
        $data['mfg'] = ($request->input('mfg') != '') ? date('Y-m-d', strtotime($request->mfg)) : null;
        $data['exp'] = ($request->input('exp') != '') ? date('Y-m-d', strtotime($request->exp)) : null;
        $data['sale'] = $request->input('sale');
        $data['category_id'] = $request->input('category_id');
        $data['brand_id'] = $request->input('brand_id');
        $data['unit_id'] = $request->input('unit_id');
        $data['supplier_id'] = $request->input('supplier_id');
        $data['description'] = ($request->input('description') != '') ? $request->input('description') : null;
        $data['barcode'] = $request->input('barcode');

        $product = Product::create($data);
        if ($product) {
            return redirect(route('admin.products.index'))->with('success', __('Successfully add more product !'));
        }
    }

    public function edit($id)
    {
        $units = Unit::get();
        $brands = Brand::get();
        $categories = Category::get();
        $suppliers = Supplier::get();
        $product = Product::find($id);
        if ($product) {
            $product->photo_url = $product->photo ? Storage::url($product->photo) : asset('image/no_img.png');
            return view('dashboard.admin.products.edit', compact('product',
                'categories', 'brands', 'units', 'suppliers'));
        }
    }

    public function update(ProductRequest $request, $id)
    {
        $request->validated();
        $product = Product::find($id);
        if ($product) {
            $path = $this->_upload($request);
            if ($path) {
                Storage::delete($product->photo);
                $product->photo = $path;
            }
            $product->name = $request->input('name');
            $product->price_in = $request->input('price_in');
            $product->price_out = $request->input('price_out');
            $product->quantity = $request->input('quantity');
            $product->quantity_alert = $request->input('quantity_alert');
            $product->mfg = ($request->input('mfg') != '') ? date('Y-m-d', strtotime($request->mfg)) : null;
            $product->exp = ($request->input('exp') != '') ? date('Y-m-d', strtotime($request->exp)) : null;
            $product->sale = $request->input('sale');
            $product->category_id = $request->input('category_id');
            $product->brand_id = $request->input('brand_id');
            $product->unit_id = $request->input('unit_id');
            $product->supplier_id = $request->input('supplier_id');
            $product->description = ($request->input('description') != '') ? $request->input('description') : null;
            $product->barcode = $request->input('barcode');
        }
        $product->save();

        return redirect(route('admin.products.index'))
            ->with('success', __('Successfully updated product !'));
    }

    public function delete(Request $request)
    {
        $product = Product::where('id', $request->productId)->first();
        if ($product) {
            DB::beginTransaction();
            try {
                //Delete all Purchase order detail then delete PurchaseOrder
                Storage::delete($product->photo);
                $product->delete();
            } catch (\Throwable $e) {
                DB::rollBack();
                Log::error($e->getMessage(), [$e->getTraceAsString()]);
                return response()->json(['status' => 422, 'msg' => 'Error when deleting']);
            }
            DB::commit();
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 404, 'msg' => 'This data cannot be found']);
        }

    }

    private function _upload($request)
    {
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $path = $photo->storeAs('public/uploads/product', $photo->getClientOriginalName());
            return $path;
        }
        return false;
    }

    public function importCSV(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        Excel::import(new ProductImport(), $path);
        return redirect()->route('admin.products.index')->with('succes',
            'Successfully added product with csv');
    }

}
