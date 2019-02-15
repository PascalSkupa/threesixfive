<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateNogoTable extends Migration
{
/**
* Run the migrations.
*
* @return void
*/
public function up()
{
Schema::create('nogo', function (Blueprint $table) {
$table->integer('pk_nogo_id')->primary();
$table->unsignedInteger('fk_n_user_id');
$table->foreign('fk_n_user_id')->references('pk_user_id')->on('users')->onDelete('cascade');
$table->unsignedInteger('fk_object');
$table->foreign('fk_object', 'fk_c_allergen')->references('pk_allergen_id')->on('allergens');
$table->foreign('fk_object', 'fk_c_categories')->references('pk_category_id')->on('categories');
$table->enum('which', ['allergen', 'category']);
});
}
/**
* Reverse the migrations.
*
* @return void
*/
public function down()
{
Schema::dropIfExists('nogo');
}
}
