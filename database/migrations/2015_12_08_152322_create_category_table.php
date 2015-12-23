<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('title', 255);
			$table->text('short');
			$table->text('description');
			$table->string('type', 255);
			$table->integer('parent');
			$table->unsignedInteger('level')->default(1);
			$table->string('url', 255)->unique();
			$table->integer('sitemap')->default(1);
			$table->integer('position')->default(0);
			$table->integer('active')->default(1);
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
		Schema::drop('category');
	}
}
