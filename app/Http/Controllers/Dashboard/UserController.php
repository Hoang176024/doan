<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function index()
    {
        return view('dashboard.user.index');
    }
    
    public function assignRole($userId)
    {
        $user = User::with('roles')->find($userId);
        $allRoles = Role::all();
        $userRole = $user->getRoleNames();
        $userRoleId = Role::where('name', $userRole)->pluck('id')->first();
        
        return view('dashboard.user.assign_role',
            compact(['user', $user], ['allRoles', $allRoles], ['userRole', $userRole],
                ['userRoleId', $userRoleId]));
    }
    
    public function assignRoleProcess(Request $request, $userId)
    {
        $request->validate([
            'role' => 'required',
        ], [
            'role.required' => 'Phải chọn ít nhất 1 vai trò cho người dùng',
        ]);
        
        $user = User::with('roles')->find($userId);
        
        //Remove old role and assign new role
        $newRole = Role::where('id', $request->role)->pluck('name')->first();
        $user->syncRoles($newRole);
        
        return redirect()->route('admin.users.index')->with('success',
            'Phân Vai trò mới cho ' . $user->full_name . ' thành công !');
    }
    
    public function getList()
    {
        $users = User::with('roles')->role(['Owner', 'Seller', 'Manager', 'None'])->orderBy('id',
            'DESC')->get()
            ->map(function ($user) {
                $user->avatar_url = $user->avatar ? Storage::url($user->avatar) : asset('image/no_img.png');
                return $user;});;
        return DataTables::of($users)->addIndexColumn()
        ->addColumn('role', function ($row) {
            return json_decode($row->getRoleNames());//getRolesNames() return Collection
        })->rawColumns(['role'])
        ->addColumn('actions', function ($row) {
            return '<div class="btn-group">
                        <a href="' . route('admin.users.assignRole', $row->id) . '">
                        <button class="role_btn btn btn-primary" value="' . $row->id . '"><i class="fas fa-pencil-alt"></i></button>
                        </a>
                         <button class="delete_btn btn btn-danger" value="' . $row->id . '"><i class="fas fa-trash-alt"></i></button>
                    </div>';
        })->rawColumns(['actions'])->make(true);
    }
    
    public function delete(Request $request)
    {
        $user = User::with('roles')->find($request->userId);
        if ($user) {
            DB::beginTransaction();
            try {
                //Remove role of user then delete user
                $userRole = $user->getRoleNames()->first();
                $user->removeRole($userRole);
                $user->delete();
            } catch (\Throwable $e) {
                DB::rollBack();
                Log::error($e->getMessage(), [$e->getTraceAsString()]);
                return response()->json(['status' => 422, 'msg' => 'Có lỗi khi xóa']);
            }
            DB::commit();
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 404, 'msg' => 'Không tìm thấy User']);
            
        }
    }
}
