<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('apps', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');

			$table->string('title', 255);
			$table->string('name', 255)->unique();
			$table->string('description', 255);
			$table->string('table', 255);
			$table->text('rows');
			$table->text('settings');
			$table->text('plugins_backend');
			$table->text('plugins_front');
			$table->string('menu_category', 255);
			$table->char('sitemap', 1)->default(1);
			$table->integer('version')->default(1);
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
		Schema::drop('apps');
    }
}
