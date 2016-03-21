<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCatalogVitayz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('catalog', function (Blueprint $table) {
			$table->string('vid_raz');
			$table->string('razmer');
			$table->string('weight');
			$table->string('vid_up');
			$table->string('date_vilov');
			$table->string('sertifikacia');
			$table->string('mesto');
			$table->string('min_part');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('catalog', function (Blueprint $table) {
			$table->dropColumn('vid_raz');
			$table->dropColumn('razmer');
			$table->dropColumn('weight');
			$table->dropColumn('vid_up');
			$table->dropColumn('date_vilov');
			$table->dropColumn('sertifikacia');
			$table->dropColumn('mesto');
			$table->dropColumn('min_part');
		});
    }
}
