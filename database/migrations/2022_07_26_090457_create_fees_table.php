<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeesTable extends Migration {

	public function up()
	{
		Schema::create('fees', function(Blueprint $table) {
			$table->id('id');
			$table->string('name')->unique();
			$table->integer('type')->unique(); // 1- registration fees // 2- school fees
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('fees');
	}
}