<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('order_details', function($table)
    {
      $table->increments('id');
      $table->string('name');
      $table->integer('price');
      $table->integer('purchase_price');
      $table->integer('quantity');
      $table->decimal('weight');
      $table->boolean('status');
      $table->string('ean13', 13);
      $table->integer('order_id')->unsigned();
      $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('order_details');
  }

}
