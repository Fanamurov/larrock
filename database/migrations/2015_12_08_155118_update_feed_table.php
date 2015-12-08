<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feed', function (Blueprint $table) {
			$table->integer('category')->unsigned()->change();
			$table->foreign('category')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feed', function (Blueprint $table) {
			$table->dropForeign('feed_category_foreign');
        });
    }
}
