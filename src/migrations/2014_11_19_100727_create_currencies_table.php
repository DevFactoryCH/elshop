<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('currencies', function($table)
    {
      $table->increments('id');
      $table->string('name');
      $table->string('iso_code', 3);
      $table->string('sign', 8);
      $table->boolean('status');
      $table->boolean('default');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('currencies');
  }

}
