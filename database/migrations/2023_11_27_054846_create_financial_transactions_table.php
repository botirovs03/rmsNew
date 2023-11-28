<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->decimal('amount', 10, 2);
            $table->date('transaction_date');
            $table->time('transaction_time');
            
            // Foreign key relationship with the users table
            $table->foreignId('user_id')->constrained()->nullable();;

            $table->enum('transaction_type', ['Cost', 'Income']);
            $table->unsignedBigInteger('order_id')->nullable();
            $table->enum('payment_method', ['Naxd', 'UzCard', 'Humo', 'Bank raqami'])->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('transaction_source')->nullable();;
            
            // Additional notes for the transaction
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financial_transactions');
    }
}
