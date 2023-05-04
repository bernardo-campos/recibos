<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    function index()
    {
        $users = User::with('roles')->get();

        return view('admin.users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.users.create', [
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        // TODO: send invitation mail on create event
        $user = User::create( $request->all() );

        $user->roles()->sync($request->roles);
        $user->permissions()->sync($request->permissions);

        return to_route('admin.users.index')->with('success', 'Usuario creado');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user->load(['roles', 'permissions']),
            'roles' => Role::all(),
            'permissions' => Permission::all(),
        ]);
    }

    public function update(StoreUserRequest $request, User $user)
    {
        $user->fill( $request->all() );
        $user->save();

        $user->roles()->sync($request->roles);
        $user->permissions()->sync($request->permissions);

        return to_route('admin.users.index')->with('success', 'Usuario actualizado');
    }
}
