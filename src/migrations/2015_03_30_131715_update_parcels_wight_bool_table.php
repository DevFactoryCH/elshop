<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateParcelsWightBoolTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('parcels', function($table) {
      $table->boolean('weight')->default(TRUE);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('parcels', function($table) {
      $table->dropColumn('weight');
    });
  }

}
