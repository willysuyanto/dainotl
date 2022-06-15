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
            $table->integer('shift');
            $table->decimal('first_totalizer',15, 1);
            $table->decimal('last_totalizer', 15, 1);
            $table->decimal('sales_on_litre', 15, 1);
            $table->decimal('sales_on_rupiah', 15, 1);
            $table->timestamps();
            $table->unsignedBigInteger('nozzle_id');
            $table->foreign('nozzle_id')
                ->references('id')
                ->on('nozzles')
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
        Schema::dropIfExists('sales');
    }
};
