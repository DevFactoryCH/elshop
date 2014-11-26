<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('orders', function($table)
    {
      $table->increments('id');
      $table->string('reference', 9);
      $table->decimal('total_weight');
      $table->integer('total_price');
      $table->integer('total_delivery');
      $table->string('delivery_number');
      $table->timestamp('payment_at')->nullable();
      $table->timestamp('treat_at')->nullable();
      $table->timestamp('delivery_at')->nullable();
      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users');
      $table->integer('currency_id')->unsigned();
      $table->foreign('currency_id')->references('id')->on('currencies');
      $table->integer('invoice_id')->unsigned();
      $table->foreign('invoice_id')->references('id')->on('addresses');
      $table->integer('delivery_id')->unsigned();
      $table->foreign('delivery_id')->references('id')->on('addresses');
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
    Schema::drop('orders');
  }

}
