<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('seo_title', 255);
			$table->string('seo_description', 255);
			$table->string('seo_keywords', 255);
			$table->integer('id_connect')->nullable();
			$table->string('url_connect', 255)->nullable();
			$table->string('type_connect', 255)->nullable();
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
		Schema::drop('seo');
    }
}
