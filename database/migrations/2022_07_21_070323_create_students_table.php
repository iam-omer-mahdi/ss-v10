<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration {

	public function up()
	{
		Schema::create('students', function(Blueprint $table) {
			$table->id('id');
			$table->string('name', 255);
			$table->text('address')->nullable();
			$table->string('guardian', 255);
			$table->string('guardian_workplace', 255)->nullable();
			$table->string('guardian_f_phone');
			$table->string('guardian_s_phone')->nullable();
			$table->string('mother_name', 255);
			$table->string('mother_f_phone', 255);
			$table->string('mother_s_phone')->nullable();
			$table->foreignId('discount_id')->nullable();
			$table->foreignId('nationality_id');
			$table->foreignId('guardian_relation_id');
			$table->foreignId('classroom_id')->constrained()->onDelete('cascade');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('students');
	}
}