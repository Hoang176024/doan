<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerGroupRequest;
use App\Models\CustomerGroup;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerGroupController extends Controller
{
    private $customerGroupModel;
    public function __construct(CustomerGroup $customerGroup)
    {
        $this->customerGroupModel = $customerGroup;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CustomerGroup::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '<a href="' . route('admin.customerGroups.edit', $data->id) . '" type="button" name="edit" id="' . $data->id . '"
                            class="edit btn btn-primary btn-sm">Edit</a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit"
                            class="delete btn btn-danger btn-sm" id="' . $data->id . '" data="' . $data->id . '">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.admin.customerGroups.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customerGroup = new CustomerGroup();
        return view('dashboard.admin.customerGroups.create', compact('customerGroup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerGroupRequest $request)
    {
        $data = $request->except('_token');
        $data = array_filter($data, 'strlen');
        $customerGroup = CustomerGroup::create($data);
        if ($request->ajax()) {
            return ['success' => 'done'];
        }
        if ($customerGroup) {
            return redirect(route('admin.customerGroups.index'))
                ->with('success', __('Crete customerGroup\'s successful!'));
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
        $customerGroup = $this->customerGroupModel->find($id);
        if ($customerGroup) {
            return view('dashboard\admin\customerGroups\edit', compact('customerGroup'));
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
    public function update(CustomerGroupRequest $request, $id)
    {
        $customerGroup = $this->customerGroupModel->find($id);
        if ($customerGroup) {
            $customerGroup->name = $request->input('name');
            $customerGroup->description = $request->input('description');
            $customerGroup->save();
        }
        return redirect(route('admin.customerGroups.index'))
            ->with('success', __('Update customerGroup\'s successful!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customerGroup = $this->customerGroupModel->find($id);
        if ($customerGroup) {
            $customerGroup->delete();
            return redirect(route('admin.customerGroups.index'))
                ->with('success', __('Delete customerGroup\'s successful!'));
        }
        return redirect(route('admin.customerGroups.index'))
            ->with('success', __('customerGroup not found!'));
    }
}
