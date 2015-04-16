<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesArticlesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('articles_categories', function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('article_id')->unsigned();
      $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
      $table->integer('category_id')->unsigned();
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    });

    Schema::table('articles', function($table) {
      $table->dropForeign('articles_category_id_foreign');
      $table->dropColumn('category_id');
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
      $table->integer('category_id')->unsigned()->nullable()->after('brand_id');
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    });
    Schema::drop('articles_categories');
  }

}
