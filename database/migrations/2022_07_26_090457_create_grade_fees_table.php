<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradeFeesTable extends Migration {

	public function up()
	{
		Schema::create('grade_fees', function(Blueprint $table) {
			$table->id('id');
			$table->foreignId('grade_id')->constrained()->onDelete('cascade');
			$table->foreignId('fee_id')->constrained()->onDelete('cascade');
			$table->integer('amount');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('grade_fees');
	}
}