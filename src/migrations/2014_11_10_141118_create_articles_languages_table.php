<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesLanguagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('articles_languages', function($table)
    {
      $table->increments('id');
      $table->string('name');
      $table->text('teaser');
      $table->text('description');
      $table->string('slug');
      $table->integer('article_id')->unsigned();
      $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
      $table->integer('language_id')->unsigned();
      $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
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
		Schema::drop('articles_languages');
	}

}
