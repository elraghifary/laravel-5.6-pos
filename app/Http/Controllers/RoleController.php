<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index');
    }

    public function store(Request $request)
    {
        $role = Role::firstOrCreate(['name' => $request->name]);

        return redirect()->back()->with(['success' => 'Role: <strong>' . $role->name . '</strong> has been submitted.']);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        
        $role->delete();

        return redirect()->back()->with(['success' => 'Role: <strong>' . $role->name . '</strong> was deleted.']);
    }

    public function getData()
    {
        $roles = Role::all();

        $i = 0;
        $data = [];
        $output = array(
            "data" => []
        );

        foreach ($roles as $key => $value) {
            $link_delete = route('role.destroy', $value->id);
            $output['data'][$i][] = $key+1;
            $output['data'][$i][] = $value->name;
            $output['data'][$i][] = $value->guard_name;
            $output['data'][$i][] = date('j M Y h:i', strtotime($value->created_at));;
            $output['data'][$i][] = '
                <form action="' . $link_delete . '" method="post">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger btn-xs" data-popup="tooltip" title="Delete Role"><i class="fa fa-trash"></i></button>
                </form>';
            $i++;
        }

        echo json_encode($output);
    }
}
