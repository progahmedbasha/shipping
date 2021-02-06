<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('resever_name', 100);
			$table->string('resver_phone', 100)->unique();
			$table->integer('supplier_id')->unsigned();
			$table->integer('city_id')->unsigned();
			$table->string('adress', 255);
			$table->integer('product_price')->unsigned();
			$table->integer('status_id')->unsigned();
			$table->text('notes')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}