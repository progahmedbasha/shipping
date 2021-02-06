<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		
		
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->foreign('status_id')->references('id')->on('status')
						->onDelete('no action')
						->onUpdate('no action');
		});
		
		Schema::table('orders', function(Blueprint $table) {
			$table->foreign('servant_id')->references('id')->on('servants')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('order_detailes', function(Blueprint $table) {
			$table->foreign('product_id')->references('id')->on('products')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('order_detailes', function(Blueprint $table) {
			$table->foreign('order_id')->references('id')->on('orders')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('cities', function(Blueprint $table) {
			$table->dropForeign('cities_governorate_id_foreign');
		});
		
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_city_id_foreign');
		});
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_status_id_foreign');
		});
		
		Schema::table('orders', function(Blueprint $table) {
			$table->dropForeign('orders_servant_id_foreign');
		});
		Schema::table('order_detailes', function(Blueprint $table) {
			$table->dropForeign('order_detailes_product_id_foreign');
		});
		Schema::table('order_detailes', function(Blueprint $table) {
			$table->dropForeign('order_detailes_order_id_foreign');
		});
	}
}