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
        Schema::create('item_sale', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->unsigned();
            $table->boolean('invoice_mode')->default(false);
            $table->double('due_price')->unsigned();
            $table->double('due_tax')->unsigned();

            $table->foreignId('sale_id')->constrained('sales');
            $table->foreignId('item_id')->constrained('items');
            
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
        Schema::dropIfExists('sales_items');
    }
};