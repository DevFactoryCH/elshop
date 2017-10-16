<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeVariationTable extends Migration
{
     /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'type_variation';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->integer('type_id')->unsigned();
            $table->integer('variation_id')->unsigned();
            $table->integer('attribut_id')->unsigned();
            $table->foreign('attribut_id')->references('id')->on('attributs');
            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('variation_id')->references('id')->on('variations');
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
