<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Permission;
use App\Models\Role;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the permissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $permissions = Permission::all();

        return view('admin.permissions.index')
        ->withPermissions($permissions);
    }

    /**
     * Show the form for creating a new permissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = Role::all();

        return view('admin.permissions.create')
        ->withRoles($roles);
    }

    /**
     * Store a newly created permissions in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required'
        ]);
        $permission = Permission::create($request->all());
        $permission->roles()->sync($request->input('roles'));

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Show the form for editing the specified permissions.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $roles = Role::all();
        $permission = Permission::find($id);

        return view('admin.permissions.edit')
        ->withPermission($permission)
        ->withRoles($roles);
    }

    /**
     * Update the specified permissions in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $permission = Permission::find($id);
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required'
        ]);
        $permission->update($request->all());
        $permission->roles()->sync($request->roles);
        
        return redirect()->route('admin.permissions.index');
    }

    /**
     * Remove the specified permissions from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Permission::whereId($id)->delete();

        return redirect()->route('admin.permissions.index');
    }
}
