<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResultsTable extends Migration {

	public function up()
	{
		Schema::create('results', function(Blueprint $table) {
			$table->id('id');
			$table->foreignId('student_id')->constrained()->onDelete('cascade');
			$table->foreignId('exam_id')->constrained()->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('results');
	}
}