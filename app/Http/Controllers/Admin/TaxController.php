<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaxRequest;
use App\Models\Admin\Tax;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaxController extends Controller
{
    private $taxModel;

    public function __construct(Tax $tax)
    {
        $this->taxModel = $tax;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tax::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . route('admin.taxes.edit',
                            $data->id) . '" type="button" name="edit" id="' . $data->id . '"
                            class="role_btn btn btn-primary"><i class="fas fa-pencil-alt"></i></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit"
                            class="delete_btn btn btn-danger" value="' . $data->id . '"><i class="fas fa-trash-alt"></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.admin.taxes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tax = new Tax();
        return view('dashboard.admin.taxes.create', compact('tax'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaxRequest $request)
    {
        $data = $request->except('_token');
        $data = array_filter($data, 'strlen');
        $tax = Tax::create($data);
        if ($request->ajax()) {
            return ['success' => 'done'];
        }
        if ($tax) {
            return redirect(route('admin.taxes.index'))
                ->with('success', __('Crete tax\'s successful!'));
        }
        return 'error!';
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tax = $this->taxModel->find($id);
        if ($tax) {
            return view('dashboard\admin\taxes\edit', compact('tax'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaxRequest $request, $id)
    {
        $tax = $this->taxModel->find($id);
        if ($tax) {
            $tax->name = $request->input('name');
            $tax->rate = $request->input('rate');
            $tax->save();
        }
        return redirect(route('admin.taxes.index'))
            ->with('success', __('Update tax\'s successful!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Tax::find($request->id);
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
}
