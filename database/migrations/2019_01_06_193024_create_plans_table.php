<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->date('pk_date');
            $table->unsignedInteger('pk_fk_user_id');
            $table->foreign('pk_fk_user_id')->references('pk_user_id')->on('users')->onDelete('cascade');
            $table->String('weekday');
            $table->integer('breakfast')->nullable();
            $table->integer('lunch')->nullable();
            $table->integer('main_dish')->nullable();
            $table->integer('snack')->nullable();
        });

        DB::unprepared('ALTER TABLE plans ADD PRIMARY KEY (pk_date, pk_fk_user_id)');
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
