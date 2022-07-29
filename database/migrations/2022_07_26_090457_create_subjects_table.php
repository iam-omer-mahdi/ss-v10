<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubjectsTable extends Migration {

	public function up()
	{
		Schema::create('subjects', function(Blueprint $table) {
			$table->id('id');
			$table->string('name')->unique();
			$table->integer('full_mark');
			$table->foreignId('grade_id')->constrained()->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('subjects');
	}
}