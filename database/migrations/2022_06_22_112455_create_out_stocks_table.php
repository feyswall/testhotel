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
        Schema::create('out_stocks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('in_stock_id');

            $table->double('quantity');
            $table->dateTime('date_out');

            $table->foreignId('stock_mode_id')->constrained('stock_modes');

            $table->integer('out_to')->nullable();

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
        Schema::dropIfExists('out_stocks');
    }
};
