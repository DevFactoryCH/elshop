<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParcelsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('parcels', function(Blueprint $table)
    {
      $table->increments('id');
      $table->decimal('min');
      $table->decimal('max');
      $table->integer('price');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('parcels');
  }

}
