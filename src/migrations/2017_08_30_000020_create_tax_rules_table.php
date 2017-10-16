<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxRulesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'tax_rules';

    /**
     * Run the migrations.
     * @table tax_rules
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {

            $table->increments('id');
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('tax_id')->unsigned();
            $table->integer('region_id')->unsigned()->nullable();


            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

            $table->foreign('tax_id')->references('id')->on('taxes');

            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
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
