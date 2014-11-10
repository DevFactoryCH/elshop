<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('articles', function($table)
    {
      $table->increments('id');
      $table->integer('price');
      $table->integer('sale_price');
      $table->boolean('status');
      $table->decimal('weight');
      $table->string('ean13', 13);
      $table->integer('brand_id')->unsigned();
      $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
    Schema::drop('articles');
  }

}
