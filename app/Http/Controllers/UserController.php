<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    //
    public function index() {
        $users = User::all();
        return Inertia::render("Users/Users", [
            'users' => $users
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ]);

        User::create($validatedData);

        return to_route('role.index');
    }

    public function destroy($id)
    {
        // Logic for deleting the resource with the given ID
        $role = User::findOrFail($id);
        $role->delete();


        return to_route('user.index');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id . ',id',
        ]);
        
        $role = User::findOrFail($id);
        $role -> update($request->all());


        return to_route('role.index');
    }


    public function roles()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

}
