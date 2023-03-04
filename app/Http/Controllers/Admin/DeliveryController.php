<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\DeliveryRequest;
use App\Models\Delivery;
use HoangPhi\VietnamMap\Models\District;
use HoangPhi\VietnamMap\Models\Province;
use HoangPhi\VietnamMap\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class DeliveryController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.delivery.index');
    }

    public function getList()
    {
        $deliveries = Delivery::with(['province', 'district', 'ward'])->orderBy('id', 'DESC')->get();
        return DataTables::of($deliveries)->addIndexColumn()
            ->addColumn('province', function ($row) {
                return $row->province->name;
            })->rawColumns(['province'])
            ->addColumn('district', function ($row) {
                return $row->district->name;
            })->rawColumns(['district'])
            ->addColumn('ward', function ($row) {
                return $row->ward->name;
            })->rawColumns(['ward'])
            ->addColumn('fee', function ($row) {
                return number_format($row->fee)  . ' VNĐ';
            })->rawColumns(['fee'])
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                        <a href="' . route('admin.deliveries.edit', $row->id) . '"">
                        <button class="role_btn btn btn-primary" value="' . $row->id . '"><i class="fas fa-pencil-alt"></i></button>
                        </a href="' . route('admin.deliveries.delete') . '"">
                         <button class="delete_btn btn btn-danger" value="' . $row->id . '"><i class="fas fa-trash-alt"></i></button>
                    </div>';
            })->rawColumns(['actions'])->make(true);
    }

    public function create()
    {
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();
        return view('dashboard.admin.delivery.add_delivery')->with(compact(['provinces', $provinces],
            ['districts', $districts], ['wards', $wards]));
    }

    public function selectDelivery(Request $request)
    {
        $data = $request->all();
        $output = '';
        if ($data['action']) {
            if ($data['action'] == 'province_id') {
                $districts = District::where('province_id', $data['id'])->get();
                $output .= '<option value="">-----Chọn Quận/Huyện-----</option>';
                foreach ($districts as $district) {

                    $output .= '<option value="' . $district->id . '">' . $district->name . '</option>';
                }
            } elseif ($data['action'] == 'district_id') {
                $wards = Ward::where('district_id', $data['id'])->get();
                $output .= '<option value="">-----Chọn Phường/Thị Trấn/Xã-----</option>';
                foreach ($wards as $ward) {
                    $output .= '<option value="' . $ward->id . '">' . $ward->name . '</option>';
                }
            }
        }
        echo $output;
    }

    public function store(DeliveryRequest $request)
    {
        $data = $request->except('_token');
        $data = array_filter($data, 'strlen');
        $delivery = Delivery::where('province_id', $request->province_id)->where('district_id', $request->district_id)
            ->where('ward_id', $request->ward_id)->first();

        if ($delivery) {
            return redirect()->route('admin.deliveries.index')->with('error',
                ('Phí Vận Chuyện đã có trong hệ thống, không cần phải thêm!'));
        } else {
            Delivery::create($data);
            return redirect()->route('admin.deliveries.index')->with('success',
                ('Thêm Mới Phí Vận Chuyển thành công !'));
        }
    }

    public function edit($id)
    {
        $delivery = Delivery::with(['province', 'district', 'ward'])->find($id);
        $provinces = Province::all();
        $districts = District::where('province_id', $delivery->province->id)->get();
        $wards = Ward::where('district_id', $delivery->district->id)->get();
        return view('dashboard.admin.delivery.edit_delivery')->with(compact(['delivery', $delivery],
            ['provinces', $provinces], ['districts', $districts], ['wards', $wards]));
    }

    public function update(DeliveryRequest $request, $id)
    {
        $delivery = Delivery::with(['province', 'district', 'ward'])->find($id);
        $delivery->province_id = $request->province_id;
        $delivery->district_id = $request->district_id;
        $delivery->ward_id = $request->ward_id;
        $delivery->fee = $request->fee;
        $delivery->save();
        return redirect()->route('admin.deliveries.index')->with('success', ('Sửa Đổi Phí Vận Chuyển thành công !'));
    }

    public function delete(Request $request)
    {
        $delivery = Delivery::with(['province', 'district', 'ward'])->find($request->id);
        if ($delivery) {
            DB::beginTransaction();
            try {
                $delivery->delete();
            } catch (\Throwable $e) {
                DB::rollBack();
                Log::error($e->getMessage(), [$e->getTraceAsString()]);
                return response()->json(['status' => 422, 'msg' => 'Có lỗi khi xóa']);
            }
            DB::commit();
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 404, 'msg' => 'Không tìm thấy dữ liệu này']);
        }
    }

    public function showFee(Request $request)
    {
        $delivery = Delivery::with(['province', 'district', 'ward'])->where('ward_id',
            $request->wardId)->first();

        if($delivery){
            return $delivery->fee;
        }else{
            return 30000;
        }
    }
}
