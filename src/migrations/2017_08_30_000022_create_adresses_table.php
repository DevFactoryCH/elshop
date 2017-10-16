<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdressesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'addresses';

    /**
     * Run the migrations.
     * @table adresses
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {

            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('street');
            $table->integer('street_number')->nullable();
            $table->integer('zip');
            $table->string('city');
            $table->integer('region_id')->unsigned()->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('region_id')->references('id')->on('regions');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
