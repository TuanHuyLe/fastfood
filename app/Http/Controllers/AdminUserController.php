<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        $users = $this->user->latest()->paginate(5);
        return view('admin.user.index', compact('users'));
    }

    public function add()
    {
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    public function store(UserAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request['name'],
                'password' => Hash::make($request['password']),
                'email' => $request['email']
            ]);
            $user->roles()->attach($request['role_id']);
            DB::commit();
            return redirect()->route('users.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' Line: ' . $exception->getLine());
            return redirect()->route('users.add');
        }
    }

    public function edit($id)
    {
        $user = $this->user->find($id);
        $roles = $this->role->all();
        $rolesOfUser = $user->roles;
        return view('admin.user.edit', compact('user', 'roles', 'rolesOfUser'));
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' => $request['name'],
                'password' => Hash::make($request['password']),
                'email' => $request['email']
            ]);
            $user = $this->user->find($id);
            $user->roles()->sync($request['role_id']);
            DB::commit();
            return redirect()->route('users.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' Line: ' . $exception->getLine());
            return redirect()->route('users.edit');
        }
    }

    public function delete($id)
    {
        try {
            $this->user->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . 'Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }

    }
}
