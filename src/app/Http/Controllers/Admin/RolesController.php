<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Role;
use App\Models\Permission;

class RolesController extends Controller
{
    /**
     * Show the roles
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
    	$roles = Role::all();

        return view('admin.roles.index')
        ->withRoles($roles);
    }

    /**
     * Show one role
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $role = Role::find($id);

        return view('admin.roles.show')
        ->withRole($role);
    }

    /**
     * Show the form for creating a role
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {    
        $permissions = Permission::all();

        return view('admin.roles.create')
        ->withPermissions($permissions);
    }

    /**
     * Store a newly created role in storage.
     *
     * @return Response
     */
    public function store(Request $request) {   
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required'
        ]);
        $role = Role::create($request->all());
        $role->perms()->sync($request->input('permissions'));

        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified role from storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @author Dessauges Antoine
     */
    public function destroy($id) {
        Role::whereId($id)->delete();

        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified role.
     *
     * @return Response
     */
    public function edit($id) {
        $permissions = Permission::all();
        $role = Role::find($id);

        return view('admin.roles.edit')
        ->withRole($role)
        ->withPermissions($permissions);
    }


    /**
     * Update the specified role in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $role = Role::find($id);   
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required'
        ]);
        $role->update($request->all());
        $role->perms()->sync($request->input('permissions'));

        return redirect()->route('admin.roles.index');
    }
}
