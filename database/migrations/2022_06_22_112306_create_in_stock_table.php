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
        Schema::create('in_stocks', function (Blueprint $table) {
            
            $table->id();
            $table->double('quantity');
            $table->dateTime('date_in');
            $table->double('old_item_price');

            $table->foreignId('stock_id')->constrained('stocks');
            $table->foreignId('item_id')->constrained('items');
            $table->foreignId('stock_mode_id')->constrained('stock_modes');

            $table->integer('in_from');
            $table->integer('item_stock_id')->nullable();

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
        Schema::dropIfExists('in_stock');
    }
};
