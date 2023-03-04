<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.categories.index');
    }

    public function getList()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return DataTables::of($categories)->addIndexColumn()
            ->addColumn('parent_id', function ($row) use ($categories) {
                foreach ($categories as $category) {
                    if ($row->parent_id == $category->id) {
                        return $category->name;
                    }
                }
            })->rawColumns(['parent_id'])
            ->addColumn('actions', function ($row) {
                return '<div class="btn-group">
                        <a class="role_btn btn btn-primary" href="' . route('admin.categories.edit', $row->id) . '">
                            <i class="fas fa-pencil-alt"></i>
                       </a>
                        <button class="delete_btn btn btn-danger" value="' . $row->id . '"><i class="fas fa-trash-alt"></i></button>
                    </div>';
            })->rawColumns(['actions'])->make(true);
    }

    public function create()
    {
        $categories = Category::get();
        return view('dashboard.admin.categories.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->except('_token');
        $data = array_filter($data, 'strlen');
        $category = Category::create($data);
        if ($category) {
            return redirect(route('admin.categories.index'))->with('success', 'New category created successfully');
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        if ($category) {
            return view('dashboard.admin.categories.edit', compact('category',
                'categories'));
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $category->description = $request->input('description');
        $category->save();
        return redirect(route('admin.categories.index'))->with('success', 'Category successfully updated');
    }

    public function destroy(Request $request)
    {
        $category = Category::find($request->id);
        if ($category) {
            DB::beginTransaction();
            try {
                $category->delete();
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
