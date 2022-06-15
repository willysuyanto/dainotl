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
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->string('so_number');
            $table->string('ref_number')->nullable();
            $table->decimal('net_price', 15, 1);
            $table->decimal('ppn_tax', 15, 1);
            $table->decimal('ppbkb_tax', 15, 1);
            $table->decimal('pph_tax', 15, 1);
            $table->decimal('transfer_fee', 15, 1)->default(5000);
            $table->decimal('total_debit_amount', 15, 1);
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
        Schema::dropIfExists('supplies');
    }
};
