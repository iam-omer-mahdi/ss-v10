<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiscountsTable extends Migration {

	public function up()
	{
		Schema::create('discounts', function(Blueprint $table) {
			$table->id('id');
			$table->string('name')->unique();
			$table->integer('amount');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('discounts');
	}
}