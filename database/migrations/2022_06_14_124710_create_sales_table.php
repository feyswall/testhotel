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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('cash_mode')->unsigned()->default(2);
            $table->double('discount')->default(0);
            $table->double('vat')->default(0)->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('pi_number')->nullable();
            $table->string('validity')->nullable();
            $table->string('due_date')->nullable();

            $table->string('payment_method_id')->nullable();

            $table->foreignId('customer_id')->constrained('customers');
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
        Schema::dropIfExists('sales');
    }
};