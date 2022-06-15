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
        // Schema::create('employees', function (Blueprint $table) {
        //     $table->id();
        //     $table->text('full_name');
        //     $table->text('employee_number')->unique();
        //     $table->text('position');
        //     $table->date('working_since');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('employees');
    }
};
