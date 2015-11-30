<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('feed', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->increments('id');

			$table->string('title', 255);
			$table->string('category', 255);
			$table->text('short');
			$table->text('description');
			$table->string('url', 155)->unique();
			$table->dateTime('date');
			$table->char('position', 10)->default(0);
			$table->integer('active', 1)->default(1);

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
		Schema::drop('feed');
    }
}
