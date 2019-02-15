<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUserDietTable extends Migration
{
    /**
        * Run the migrations.
        *
        * @return void
        */
    public function up()
    {
        Schema::create('user_diets', function (Blueprint $table) {
            $table->unsignedInteger('pk_fk_d_user_id');
            $table->foreign('pk_fk_d_user_id')->references('pk_user_id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('pk_fk_u_diets_id');
            $table->foreign('pk_fk_u_diets_id')->references('pk_diet_id')->on('diets');
        });

        DB::unprepared('ALTER TABLE user_diets ADD PRIMARY KEY (pk_fk_d_user_id, pk_fk_u_diets_id)');
    }
    /**
        * Reverse the migrations.
        *
        * @return void
        */
    public function down()
    {
        Schema::dropIfExists('user_diets');
    }
}
