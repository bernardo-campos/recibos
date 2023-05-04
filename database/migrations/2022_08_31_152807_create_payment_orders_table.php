<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_orders', function (Blueprint $table) {
            $table->id()->from(21901);
            $table->date('date');
            $table->string('date_string');
            $table->string('invoice_number')->nullable();
            $table->foreignId('to_id')->constrained();
            $table->foreignId('concept_id')->constrained();
            $table->foreignId('establishment_id')->constrained();
            $table->foreignId('currency_id')->nullable()->constrained();
            $table->decimal('amount_total', 14, 2);
            $table->string('amount_total_words');
            $table->enum('type', ['EFECTIVO','CHEQUE','DEPÓSITO', 'TRANSFERENCIA', 'OTRO']);
            $table->foreignId('account_id')->nullable()->constrained();
            $table->string('note')->nullable();
            $table->foreignId('created_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_orders');
    }
};
