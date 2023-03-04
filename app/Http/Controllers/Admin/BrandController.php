<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    private $brandModel;
    public function __construct(Brand $brand)
    {
        $this->brandModel = $brand;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::latest()->get();
            return DataTables::of($data)
                ->editColumn('photo', function ($data) {
                    return '<img src="' . $data->photo . '" alt="" width="80px" class="img center mx-auto d-block rounded img-avatar-list">';
                })
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . route('admin.brands.edit', $data->id) . '" type="button" name="edit" id="' . $data->id . '"
                            class="role_btn btn btn-primary"><i class="fas fa-pencil-alt"></i></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit"
                            class="delete_btn btn btn-danger" value="' . $data->id . '"><i class="fas fa-trash-alt"></button>';
                    return $button;
                })
                ->rawColumns(['photo', 'action'])
                ->make(true);
        }
        return view('dashboard.admin.brands.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = new Brand();
        return view('dashboard.admin.brands.create', compact('brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $data = $request->except('_token');
        $data = array_filter($data, 'strlen');
        $path = $this->upload($request);
        if ($path) {
            $data['photo'] = $path;
        }
        $brand = Brand::create($data);
        if ($request->ajax()) {
            return ['success' => 'done'];
        }
        if ($brand) {
            return redirect(route('admin.brands.index'))
                ->with('success', __('Crete brand\'s successful!'));
        }
        return 'error!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = $this->brandModel->find($id);
        if ($brand) {
            return view('dashboard\admin\brands\edit', compact('brand'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        $brand = $this->brandModel->find($id);
        if ($brand) {
            $path = $this->upload($request);
            if ($path) {
                $brand->photo = $path;
            }
            $brand->name = $request->input('name');

            $brand->save();
        }
        return redirect(route('admin.brands.index'))
            ->with('success', __('Update brand\'s successful!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Brand::find($request->id);
        if ($data) {
            DB::beginTransaction();
            try {
                $data->delete();
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
    /**
     * Upload photo
     * @param mixed $request
     * @return string|boolean
     */
    private function upload($request)
    {
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $path = $photo->move('uploads/brand', $photo->getClientOriginalName());
            return $path;
        }
        return false;
    }
}
