<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('servant_id')->unsigned();
			$table->integer('status_id')->unsigned();
			$table->integer('total_prices')->unsigned()->default('0');
			$table->text('notes')->nullable();
			$table->softDeletes();

		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}