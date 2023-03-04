<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Unit;

use App\Http\Requests\Dashboard\UnitRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UnitController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $data = Unit::latest()->get();
            return DataTables::of($data)
            ->addColumn('action', function($data){
                $button = '<a href="'.route('admin.units.edit', $data->id).'" type="button" name="edit" id="'.$data->id.'"
                            class="role_btn btn btn-primary"><i class="fas fa-pencil-alt"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit"
                            class="delete_btn btn btn-danger" " value="'.$data->id.'"><i class="fas fa-trash-alt"></button>';
               
                return $button;
            })
            
            ->make(true);
        }
        
        return view('dashboard.units.index');
    }
    
    public function anyData(){
        return Datatables::of(Unit::query())->make(true);
        
    }
    
    public function create(){
        $unit = new Unit();
        return view('dashboard.units.create')->with(compact('unit'));
    }
    
    public function store(UnitRequest $request)
    {
        $data = $request->except('_token');
        $data = array_filter($data, 'strlen');
        $unit = Unit::create($data);
        
        if ($unit)
        {
            return redirect(route('admin.units.index'))
            ->with('success', __('Create units\'s success!'));
        }
        return 'error!';
        
    }
    
    public function edit($id){
        $unit = Unit::find($id);
        if ($unit)
        {
            return view('dashboard.units.edit', compact('unit'));
        }
        
        abort(404);
        
    }
    public function update(UnitRequest $request, $id){
      
            $unit = Unit::find($id);
            if($unit){
                $unit->unit_code = $request ->input('unit_code');
                $unit->unit_name = $request ->input('unit_name');
                $unit->save();
                
            }
            return redirect(route('admin.units.index'))
            ->with('success', __('Update Unit\'s success!'));
        }
  
    public function destroy(Request $request){ 
        $data = Unit::find($request->id);
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
