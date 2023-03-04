<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    private $customerModel;

    /**
     * CustomerController constructor.
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customerModel = $customer;
    }

    public function index(Request $request)
    {
        $data = Customer::get();
        if ($request->ajax()) {
            return DataTables::of($data)    
                ->addColumn('action', function ($data) {
                    // $button = '<button type="button" name="edit" id="'.$data->id.'"
                    //     class="edit btn btn-primary btn-sm">Edit</button>';
                    $button = '<a href="' . route('admin.customers.edit', $data->id) . '" type="button" name="edit" id="' . $data->id . '"
                            class="role_btn btn btn-primary"><i class="fas fa-pencil-alt"></i></a>';
                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit"
                            class="delete_btn btn btn-danger"  value="' . $data->id . '"><i class="fas fa-trash-alt"></button>';
                    return $button;
                })
                ->make(true);
        }
        return view('dashboard.customer.index');
    }

    public function anyData()
    {
        return DataTables::of(Customer::query())->make(true);
    }

    public function create()
    {
        return view('dashboard.customer.create');
    }

    public function store(CustomerRequest $request)
    {
        $data = $request->except('_token');
        $data = array_filter($data, 'strlen');
        $customer = Customer::create($data);
        if ($customer) {
            return redirect(route('admin.customers.index'))
                ->with('success', __('Create customer is success!'));
        }
        return 'error!';
    }

    public function edit($id)
    {
        $customer = $this->customerModel->find($id);

        if ($customer) {
            return view('dashboard.customer.edit', compact('customer'));
        }

        abort(404);
    }

    public function update(CustomerRequest $request, $id)
    {
        $customer = $this->customerModel->find($id);
        if ($customer) {
            $customer->name = $request->input('name');
            $customer->address = $request->input('address');
            $customer->phone = $request->input('phone');
            $customer->email = $request->input('email');
            $customer->save();
        }
        return redirect(route('admin.customers.index'))
            ->with('update success', __('Update customer\'s success!'));
    }

    public function destroy(Request $request)
    {
        $data = Customer::find($request->id);
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

    public function importForm()
    {
        return view('dashboard.customer.import-form');
    }

    public function import(Request $request)
    {
        Excel::import(new CustomerImport, $request->file);
        return redirect(route('admin.customers.index'))
            ->with('update success', __('Import customer\'s success!'));
    }
}
