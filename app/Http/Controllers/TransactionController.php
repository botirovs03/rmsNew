<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\FinancialTransaction;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = FinancialTransaction::with('user')->get();
        return Inertia::render("Transactions/Transactions", [
            'transactions' => $transactions
        ]);
    }

    public function show($id)
    {
        $user = FinancialTransaction::with('user')->findOrFail($id);
        return $user;
    }



    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string|max:255',
            'notes' => 'nullable|string|max:255',
            'payment_method' => 'nullable|string|max:255',
            'transaction_type' => 'required|in:Cost,Income',
            'transaction_date' => 'required|date_format:Y-m-d',
            'transaction_time' => 'required|date_format:H:i',
            // Add other validation rules as needed
        ]);

        // Create a new FinancialTransaction using Eloquent
        $transaction = FinancialTransaction::create($validatedData);

        // Optionally, you can return a response, redirect, or perform other actions
        return redirect()->route('transaction.index'); // Adjust the route name as needed
    }

    public function destroy($id)
    {
        // Logic for deleting the resource with the given ID
        $transactions = FinancialTransaction::findOrFail($id);
        $transactions->delete();


        return to_route('transaction.index');
    }


    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string|max:255',
            'notes' => 'nullable|string|max:255',
            'payment_method' => 'nullable|string|max:255',
            'transaction_type' => 'required|in:Cost,Income',
            'transaction_date' => 'required|date_format:Y-m-d',
            'transaction_time' => 'required|date_format:H:i',
            // Add other validation rules as needed
        ]);


        // Find the user by ID
        $transactions = FinancialTransaction::findOrFail($id);


        // Update the user with the validated data
        $transactions->update($validatedData);

        return redirect()->route('transaction.index');
    }
}
