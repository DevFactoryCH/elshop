<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesPricesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('articles_prices', function($table)
    {
      $table->increments('id');
      $table->integer('price');
      $table->boolean('sale_price');
      $table->integer('article_id')->unsigned();
      $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
      $table->integer('currency_id')->unsigned();
      $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('articles_prices');
  }

}
