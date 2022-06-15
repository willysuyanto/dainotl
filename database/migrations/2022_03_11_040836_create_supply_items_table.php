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
        Schema::create('supply_items', function (Blueprint $table) {
            $table->id();
            $table->integer('trip');
            $table->decimal('trip_quantity', 15, 1);
            $table->decimal('confirmed_quantity', 15, 1);
            $table->timestamps();
            $table->unsignedBigInteger('supply_id');
            $table->foreign('supply_id')
                ->references('id')
                ->on('supplies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('supply_items');
    }
};
