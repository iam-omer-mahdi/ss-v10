<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamsTable extends Migration {

	public function up()
	{
		Schema::create('exams', function(Blueprint $table) {
			$table->id('id');
			$table->string('name')->unique();
			$table->foreignId('grade_id')->constrained()->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('exams');
	}
}