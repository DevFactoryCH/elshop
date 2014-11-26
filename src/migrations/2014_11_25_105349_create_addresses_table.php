<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('addresses', function($table)
    {
      $table->increments('id');
      $table->string('email');
      $table->string('firstname');
      $table->string('lastname');
      $table->string('address');
      $table->string('zip');
      $table->string('locality');
      $table->string('phone');
      $table->boolean('status');
      $table->boolean('type');
      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
    Schema::drop('addresses');
  }

}
