<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPositionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_positions', function(Blueprint $table)
		{
            $table->increments('id');
			$table->integer('order_id')->unsigned();
            $table->integer('good_id')->unsigned();
            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->foreign('good_id')->references('good_id')->on('goods');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_positions');
	}

}
