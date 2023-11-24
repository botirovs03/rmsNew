<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Role;

class RoleController extends Controller
{
    //
    public function index()
    {
        $roles = Role::all();
        return Inertia::render("Roles/Roles", [
            'roles' => $roles
        ]);
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return $role;
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ]);

        Role::create($validatedData);

        return to_route('role.index');
    }

    public function destroy($id)
    {
        // Logic for deleting the resource with the given ID
        $role = Role::findOrFail($id);
        $role->delete();


        return to_route('role.index');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id . ',id',
        ]);
        
        $role = Role::findOrFail($id);
        $role -> update($request->all());


        return to_route('role.index');
    }
}
