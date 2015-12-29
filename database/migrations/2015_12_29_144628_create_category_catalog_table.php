<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryCatalogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_catalog', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->integer('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->integer('catalog_id')->unsigned();
			$table->foreign('catalog_id')->references('id')->on('catalog')->onDelete('cascade');
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
        Schema::drop('category_catalog');
    }
}
