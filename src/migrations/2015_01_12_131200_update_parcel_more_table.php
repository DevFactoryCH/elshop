<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateParcelMoreTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('parcels', function($table) {
      $table->boolean('type')->default(FALSE);
    });
    DB::statement('ALTER TABLE parcels MODIFY COLUMN min INT'); 
    DB::statement('ALTER TABLE parcels MODIFY COLUMN max INT');
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('parcels', function($table) {
      $table->dropColumn('type');
    });
    DB::statement('ALTER TABLE parcels MODIFY COLUMN min FLOAT'); 
    DB::statement('ALTER TABLE parcels MODIFY COLUMN max FLOAT');
  }

}
