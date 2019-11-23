<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use Session;
class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('panel.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('panel.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  =>  'required|string'
        ]);

        $role = Role::create([
            'name'      =>  $request->name,
            'section'   =>  'panel'
        ]);

        if($request->has('permissions')){
            $role->permissions()->sync($request->permissions);
        }

        Session::flash('message', 'Registro guardado');

        return redirect()->route('roles.index');

    }

    public function edit($id)
    {
        $permissions = Permission::all();
        $role = Role::with('permissions')->find($id);

        return view('panel.role.edit', compact('role','permissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  =>  'required|string'
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        if($request->has('permissions')){
            $role->permissions()->sync($request->permissions);
        }

        Session::flash('message', 'Registro actualizado');

        return redirect()->route('roles.index');

    }

    public function destroy($id)
    {
        $role = Role::find($id);

        $role->delete();

        Session::flash('message', 'Registro eliminado');

        return redirect()->route('roles.index');
    }
}
