<?php
// app/Models/FinancialTransaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'amount',
        'transaction_date',
        'transaction_time',
        'user_id',
        'transaction_type',
        'order_id',
        'payment_method',
        'invoice_number',
        'transaction_source',
        'notes',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'transaction_time' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
