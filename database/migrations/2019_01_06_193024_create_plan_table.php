<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan', function (Blueprint $table) {
            $table->date('pk_date');
            $table->unsignedInteger('pk_fk_user_id');
            $table->foreign('pk_fk_user_id')->references('pk_user_id')->on('users')->onDelete('cascade');
            $table->String('weekday');
            $table->integer('breakfast');
            $table->integer('lunch');
            $table->integer('dinner');
            $table->integer('snack');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan');
    }
}
