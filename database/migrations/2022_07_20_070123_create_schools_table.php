<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchoolsTable extends Migration {

	public function up()
	{
		Schema::create('schools', function(Blueprint $table) {
			$table->id('id');
			$table->string('name', 255)->unique();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('schools');
	}
}