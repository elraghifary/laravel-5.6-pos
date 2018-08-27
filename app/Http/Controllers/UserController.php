<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use DB;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function create()
    {
        $roles = Role::orderBy('name', 'ASC')->get();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $user = User::firstOrCreate([
            'email' => $request->email
        ], [
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'status' => true
        ]);

        $user->assignRole($request->role);

        return redirect(route('user.index'))->with(['success' => 'User: <strong>' . $user->name . '</strong> has been submitted.']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $password = !empty($request->password) ? bcrypt($request->password) : $user->password;

        $user->update([
            'name' => $request->name,
            'password' => $password
        ]);

        return redirect(route('user.index'))->with(['success' => 'User: <strong>' . $user->name . '</strong> has been modified.']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()->with(['success' => 'User: <strong>' . $user->name . '</strong> was deleted.']);
    }

    public function roles(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $roles = Role::all()->pluck('name');

        return view('users.roles', compact('user', 'roles'));
    }

    public function setRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->syncRoles($request->role);

        return redirect()->back()->with(['success' => 'Role has been set.']);
    }

    public function rolePermission(Request $request)
    {
        $role = $request->get('role');

        $permissions = null;
        $hasPermission = null;

        $roles = Role::all()->pluck('name');

        if (!empty($role)) {
            $getRole = Role::findByName($role);

            $hasPermission = DB::table('role_has_permissions')
                ->select('permissions.name')
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                ->where('role_id', $getRole->id)->get()->pluck('name')->all();

            $permissions = Permission::all()->pluck('name');
        }

        return view('users.role_permission', compact('roles', 'permissions', 'hasPermission'));
    }

    public function addPermission(Request $request)
    {
        $permission = Permission::firstOrCreate([
            'name' => $request->name
        ]);

        return redirect()->back()->with(['success' => 'Permission has been submitted.']);
    }

    public function setRolePermission(Request $request, $role)
    {
        $role = Role::findByName($role);

        $role->syncPermissions($request->permission);

        return redirect()->back()->with(['success' => 'Permission to role saved.']);
    }

    public function getData()
    {
        $users = User::all();

        $i = 0;
        $data = [];
        $output = array(
            "data" => []
        );

        foreach ($users as $key => $value) {
            $link_show = route('user.show', $value->id);
            $link_role = route('user.roles', $value->id);
            $link_edit = route('user.edit', $value->id);
            $link_delete = route('user.destroy', $value->id);
            $output['data'][$i][] = $key+1;
            $output['data'][$i][] = $value->name;
            $output['data'][$i][] = $value->email;
            $output['data'][$i][] = $value->status;
            $output['data'][$i][] = '
                <form action="' . $link_delete . '" method="post">
                    <a href="' . $link_role . '" class="btn btn-info btn-xs" data-popup="tooltip" title="Role User"><i class="fa fa-user-secret"></i></a>
                    <a href="' . $link_show . '" class="btn btn-default btn-xs" data-popup="tooltip" title="Show User"><i class="fa fa-eye"></i></a>
                    <a href="' . $link_edit . '" class="btn btn-warning btn-xs" data-popup="tooltip" title="Edit User"><i class="fa fa-edit"></i></a>
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger btn-xs" data-popup="tooltip" title="Delete User"><i class="fa fa-trash"></i></button>
                </form>';
            $i++;
        }

        echo json_encode($output);
    }
}