<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    //
    public function index()
    {
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


    public function getRoles()
    {
        $roles = Role::all();
        return response()->json($roles);
    }


    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8', // Adjust the minimum length as needed
            'gender' => 'required|in:Male,Female',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id'
            // Add other validation rules as needed
        ]);

        // Hash the password before storing it in the database
        $validatedData['password'] = Hash::make($validatedData['password']);
        // dd($validatedData);
        User::create($validatedData);

        return to_route('user.index');
    }

    public function destroy($id)
    {
        // Logic for deleting the resource with the given ID
        $user = User::findOrFail($id);
        $user->delete();


        return to_route('user.index');
    }


    public function update(Request $request, $id)
    {
        // Validation for fields other than 'password'
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $id . ',id',
            'email' => 'required|email|unique:users,email,' . $id . ',id', // Added unique validation for email
            'gender' => 'required|in:Male,Female',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Check if 'password' should be updated
        if ($request->ispassword) {
            // Validation for 'password'
            $request->validate([
                'password' => 'required|string|min:8',
            ]);
            // Update the 'password' in the $validatedData array
            $validatedData['password'] = Hash::make($request->password);
        }

        // Find the user by ID
        $user = User::findOrFail($id);


        // Update the user with the validated data
        $user->update($validatedData);

        return redirect()->route('user.index');
    }
}
