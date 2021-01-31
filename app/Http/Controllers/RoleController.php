<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', ['roles' => $roles]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required'],
        ]);

        $role = Role::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-'),
        ]);

        session()->flash('message_role_created', 'Role: ' . $role->name . ' has been created');

        return back();
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::all(),
        ]);
    }

    public function update(Role $role)
    {
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(request('name'))->slug('-');

        if ($role->isDirty('name')) {
            $role->save();
            session()->flash('message_role_updated', 'Role: ' . $role->name . ' has been updated');
            return redirect()->route('roles.index');
        } else {

            session()->flash('message_role_updated_fill_the_name', 'Nothing has been updated');
            return back();
        }

    }

    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('message_role_delete', 'Role: ' . $role->name . ' has been deleted');
        return back();
    }

    public function attach_permission(Role $role)
    {

        $role->permissions()->attach(request('permission'));
        return back();
    }

    public function detach_permission(Role $role)
    {

        $role->permissions()->detach(request('permission'));
        return back();
    }

}
