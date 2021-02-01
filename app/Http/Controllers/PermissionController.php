<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', ['permissions' => $permissions]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required'],
        ]);

        $permission = Permission::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-'),
        ]);

        session()->flash('message_permission_created', 'Permission: ' . $permission->name . ' has been created');

        return back();
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', ['permission' => $permission]);
    }

    public function update(Permission $permission)
    {
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(request('name'))->slug('-');

        if ($permission->isDirty('name')) {
            $permission->save();
            session()->flash('message_permission_updated', 'Permission: ' . $permission->name . ' has been updated');
            return redirect()->route('permissions.index');
        } else {

            session()->flash('message_permission_updated_fill_the_name', 'Nothing has been updated');
            return back();
        }

    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        session()->flash('message_permission_delete', 'Permission: ' . $permission->name . ' has been deleted');
        return back();
    }

}
