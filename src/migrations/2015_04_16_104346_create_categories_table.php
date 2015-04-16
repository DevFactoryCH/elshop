<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('categories', function(Blueprint $table) {
      $table->increments('id');
      $table->string('category');
      $table->boolean('status')->default(TRUE);
      $table->integer('category_id')->unsigned()->nullable();
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
      $table->timestamps();
    });

    Schema::table('articles', function($table) {
      $table->integer('category_id')->unsigned()->nullable()->after('brand_id');
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('articles', function($table) {
      $table->dropForeign('articles_category_id_foreign');
      $table->dropColumn('category_id');
    });
    Schema::drop('categories');
  }

}
