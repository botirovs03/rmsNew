<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Table;

class TableController extends Controller
{
    //
    public function index()
    {
        $tables = Table::with('user')->get();
        return Inertia::render("Tables/Tables", [
            'tables' => $tables
        ]);
    }

    public function show($id)
    {
        $user = Table::with('user')->findOrFail($id);
        return $user;
    }



    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'table_number' => 'required|string|max:10',
            'capacity' => 'required|integer',
            'status' => 'required|in:Available,Occupied',
            // Add other validation rules as needed
        ]);
        // Create a new FinancialTransaction using Eloquent
        $table = Table::create($validatedData);

        // Optionally, you can return a response, redirect, or perform other actions
        return redirect()->route('table.index'); // Adjust the route name as needed
    }

    public function destroy($id)
    {
        // Logic for deleting the resource with the given ID
        $table = Table::findOrFail($id);
        $table->delete();


        return to_route('table.index');
    }


    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'table_number' => 'required|string|max:10',
            'capacity' => 'required|integer',
            'status' => 'required|in:Available,Occupied',
            // Add other validation rules as needed
        ]);


        // Find the user by ID
        $table = Table::findOrFail($id);


        // Update the user with the validated data
        $table->update($validatedData);

        return redirect()->route('table.index');
    }
}
