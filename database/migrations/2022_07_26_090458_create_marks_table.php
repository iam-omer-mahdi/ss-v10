<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarksTable extends Migration {

	public function up()
	{
		Schema::create('marks', function(Blueprint $table) {
			$table->id('id');
			$table->double('mark');
			$table->foreignId('result_id')->constrained()->onDelete('cascade');
			$table->foreignId('subject_id')->constrained()->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('marks');
	}
}