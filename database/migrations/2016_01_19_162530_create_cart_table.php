<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('order_id');
			$table->integer('user');
			$table->text('items');
			$table->double('cost', 10, 2)->default(0.00);
			$table->double('cost_discount', 10, 2)->nullable();
			$table->char('kupon');
			$table->char('status_order');
			$table->char('status_pay');
			$table->char('method_pay');
			$table->char('method_delivery');
			$table->text('comment');
			$table->integer('position')->default(0);

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
		Schema::drop('cart');
    }
}
