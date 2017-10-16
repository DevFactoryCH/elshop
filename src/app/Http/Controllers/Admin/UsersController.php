<?php

namespace Devfactory\Elshop\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;

class UsersController extends Controller
{
    /**
     * Show the users
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
    	$users = User::all();

        return view('admin.users.index')
        ->withUsers($users);
    }

    /**
     * Show one user
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = User::find($id);

        return view('admin.users.show')
        ->withUser($user);
    }

     /**
     * Show the form for creating a user
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = Role::all();

        return view('admin.users.create')
        ->withRoles($roles);
    }


     /**
     * Show the form for editing the specified user.
     *
     * @return Response
     */
    public function edit($id) {
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.users.edit')
        ->withUser($user)
        ->withRoles($roles);
    }

     /**
     * Update the specified user in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::find($id);
        /* Basic information form */
        if ($request->has('basic')) {           
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'roles' => 'required',
                'email' => 'required|email|unique:users,email,'.$id 
            ]);
            $user->update($request->all());
            $user->roles()->sync($request->roles);

            return redirect()->route('admin.users.index');
        }
        /* Reset password form */
        if ($request->has('reset_pswd')) {
            $this->validate($request, [
                'password' => 'required|min:6|confirmed',
            ]);
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('admin.users.index');
        }

    }

    /**
     * Remove the specified user from storage.
     *
     * @return \Illuminate\Http\Response
     *
     * @author Dessauges Antoine
     */
    public function destroy($id) {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    /**
     * Store a newly created user in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users', 
            'password' => 'required|min:6|confirmed',
            'roles' => 'required',
        ]);
        $user = User::create($request->all());
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index');
    }

}
