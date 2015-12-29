<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('title', 255);
			$table->text('short');
			$table->text('description');
			$table->string('url', 155)->unique()->index();
			$table->string('what', 55);
			$table->double('cost', 10, 2)->default(0.00);
			$table->double('cost_old', 10, 2)->nullable();
			$table->string('manufacture', 255);
			$table->integer('position')->default(0);
			$table->string('articul', 55);
			$table->integer('active')->default(1);
			$table->integer('nalichie')->default(0);
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
        Schema::drop('catalog');
    }
}
