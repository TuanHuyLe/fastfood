<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminPermissionController extends Controller
{
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function create()
    {
        return view('admin.permission.add');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $permission = $this->permission->firstOrCreate([
                'name' => $request['module_parent'],
                'display_name' => $request['module_parent'],
                'parent_id' => 0
            ]);
            foreach ($request->module_children as $child) {
                $this->permission->firstOrCreate([
                    'name' => $child,
                    'display_name' => $child,
                    'parent_id' => $permission->id,
                    'key_code' => $child . '_' . $request['module_parent']
                ]);
            }
            DB::commit();
        } catch (\Exception $exception) {
            Log::error('Error: ' . $exception->getMessage() . ' Line: ' . $exception->getLine());
            DB::rollBack();
        }
        return redirect()->route('permissions.create');
    }
}
