<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFinancialtransactionsTriggers extends Migration
{
    public function up()
    {
        // Trigger for INSERT
        $triggerInsertSql = "
            CREATE TRIGGER update_financial_totals_after_insert
            AFTER INSERT ON financial_transactions
            FOR EACH ROW
            BEGIN
                IF NEW.transaction_type = 'Income' THEN
                    UPDATE financial_totals
                    SET total_income = total_income + NEW.amount;
                ELSE
                    UPDATE financial_totals
                    SET total_cost = total_cost + NEW.amount;
                END IF;
            END;
        ";

        DB::unprepared($triggerInsertSql);

        // Trigger for UPDATE
        $triggerUpdateSql = "
            CREATE TRIGGER update_financial_totals_after_update
            AFTER UPDATE ON financial_transactions
            FOR EACH ROW
            BEGIN
                IF OLD.transaction_type = 'Income' THEN
                    UPDATE financial_totals
                    SET total_income = total_income - OLD.amount;
                ELSE
                    UPDATE financial_totals
                    SET total_cost = total_cost - OLD.amount;
                END IF;

                IF NEW.transaction_type = 'Income' THEN
                    UPDATE financial_totals
                    SET total_income = total_income + NEW.amount;
                ELSE
                    UPDATE financial_totals
                    SET total_cost = total_cost + NEW.amount;
                END IF;
            END;
        ";

        DB::unprepared($triggerUpdateSql);

        // Trigger for DELETE
        $triggerDeleteSql = "
            CREATE TRIGGER update_financial_totals_after_delete
            AFTER DELETE ON financial_transactions
            FOR EACH ROW
            BEGIN
                IF OLD.transaction_type = 'Income' THEN
                    UPDATE financial_totals
                    SET total_income = total_income - OLD.amount;
                ELSE
                    UPDATE financial_totals
                    SET total_cost = total_cost - OLD.amount;
                END IF;
            END;
        ";

        DB::unprepared($triggerDeleteSql);
    }

    public function down()
    {
        // Drop the triggers
        DB::unprepared('DROP TRIGGER IF EXISTS update_financial_totals_after_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS update_financial_totals_after_update');
        DB::unprepared('DROP TRIGGER IF EXISTS update_financial_totals_after_delete');
    }
}
