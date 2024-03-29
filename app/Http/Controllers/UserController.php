<?php

namespace App\Http\Controllers;

use App\Models\Kabs;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    //

    public function index()
    {
        Paginator::useBootstrap();
        $auth = Auth::user();
        if (in_array('user_list', $auth->getPermissionsViaRoles()->pluck('name')->toArray())) {
            $user = User::orderBy('name')->paginate(15);
        } else {
            return redirect('/')->with('error', "Tidak Memiliki Akses");
        }
        $data_roles = Role::all();
        return view('user.index', compact('user', 'data_roles', 'auth'));
    }

    public function create()
    {
        $auth = Auth::user();
        $user = new User();
        $data_roles = [];
        $kabs = Kabs::all();
        if (in_array('SUPER ADMIN', $auth->getRoleNames()->toArray())) {
            $data_roles = Role::all();
        } else {
            return redirect('users')->with('error', "Tidak Memiliki Akses");
        }

        return view('user.create', compact('data_roles', 'user', 'auth', 'kabs'));
    }


    public function store(Request $request)
    {
        $auth = Auth::user();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'instansi' => $request->instansi,
                'bagian' => $request->bagian,
                'no_hp' => $request->no_hp,
                'kd_wilayah' => $request->kd_wilayah,
                'password' => Hash::make($request->password),
                'created_by' => $auth->id,
            ]);
            return redirect('users')->with('message', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect('users\create')->withInput()->with('error', $ex->getMessage());
        }
    }

    public function show($id)
    {
        $auth = Auth::user();
        $id = Crypt::decryptString($id);
        $user = User::where('id', $id)->first();
        $kabs = Kabs::all();
        return view('user.show', compact('user', 'id', 'auth', 'kabs'));
    }

    public function update(Request $request)
    {
        $auth = Auth::user();
        User::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'instansi' => $request->instansi,
                'bagian' => $request->bagian,
                'no_hp' => $request->no_hp,
                'kd_wilayah' => $request->kd_wilayah,
                'password' => Hash::make($request->password),
                'updated_by' =>  $auth->id,
            ]);
        return redirect()->back()->with('success', 'Berhasil Disimpan');
    }

    public function delete(Request $request)
    {
        User::where('id', $request->user_id)->delete();
        return redirect()->back()->with('success', 'Berhasil Dihapus');
    }


    public function ubahpassword(Request $request)
    {
        User::where('id', $request->id)
            ->update([
                'password' => Hash::make($request->password),
            ]);
        return redirect()->back()->with('success', 'Berhasil Disimpan');
    }


    public function user_roles(Request $request)
    {
        $user = User::find($request->user_id);
        $user->syncRoles([$request->roles]);
        return redirect('users/')->with('success', 'User berhasil diperbaharui.');
    }

    public function roles()
    {
        $auth = Auth::user();
        $data_roles = [];
        $roles = Role::all();
        foreach ($roles as $role) {
            $permissions = $role->permissions()->get();
            $data_role = [
                'id' => $role->id,
                'name' => $role->name,
                'guard_name' => $role->guard_name,
                'created_at' => $role->created_at,
                'updated_at' => $role->updated_at,
                'permissions' => $permissions
            ];
            array_push($data_roles, $data_role);
        }
        $data_permission = Permission::all();
        return view('user/roles', compact('data_roles', 'data_permission', 'auth'));
    }

    public function roles_add(Request $request)
    {
        $role = Role::create(['name' => $request->name, 'guard_name' => $request->guard_name]);
        $role->givePermissionTo($request->permissions);
        return redirect()->back()->with('message', 'Berhasil Disimpan');
    }

    public function roles_edit(Request $request)
    {
        $role =  Role::find($request->id);
        Role::where('id', $request->id)->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->back()->with('message', 'Berhasil Disimpan');
    }

    public function roles_delete(Request $request)
    {
        Role::where('id', $request->id)->delete();
        return redirect()->back()->with('message', 'Berhasil Disimpan');
    }

    public function permissions()
    {
        $auth = Auth::user();
        $permission = Permission::paginate(15);
        return view('user/permissions', compact('permission', 'auth'));
    }

    public function permissions_add(Request $request)
    {
        Permission::create(['name' => $request->name, 'guard_name' => $request->guard_name]);
        return redirect()->back()->with('message', 'Berhasil Disimpan');
    }

    public function permissions_delete(Request $request)
    {
        $affectedRows = Permission::where('id', $request->id)->delete();
        if ($affectedRows > 0) {
            return redirect()->back()->with('message', 'Berhasil Disimpan');
        } else {
            return redirect()->back()->with('error', 'Gagal Disimpan');
        }
    }
}
