<?php

// database/migrations/xxxx_xx_xx_create_financialtotals_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFinancialtotalsTable extends Migration
{
    public function up()
    {
        Schema::create('financial_totals', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_income', 10, 2)->default(0);
            $table->decimal('total_cost', 10, 2)->default(0);
            $table->timestamps();
            
            // Add a unique constraint to ensure only one row is present
            $table->unique(['id']);
        });

        // Insert the initial row
        DB::table('financial_totals')->insert([
            'total_income' => 0,
            'total_cost' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('financial_totals');
    }
}
