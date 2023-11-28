<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFinancialTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('financial_transactions', function (Blueprint $table) {
            // Make user_id field nullable
            $table->unsignedBigInteger('user_id')->nullable()->change();

            // Make transaction_source field nullable
            $table->string('transaction_source')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('financial_transactions', function (Blueprint $table) {
            // If needed, you can revert the changes here
            $table->unsignedBigInteger('user_id')->change();
            $table->string('transaction_source')->change();
        });
    }
}
