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
			$table->integer('category');
			$table->text('short');
			$table->text('description');
			$table->string('url', 155)->unique();
			$table->date('date');
			$table->integer('position')->default(0);
			$table->integer('active')->default(1);
			$table->timestamps();

			$table->foreign('category')->references('id')->on('category')->onDelete('cascade');
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
