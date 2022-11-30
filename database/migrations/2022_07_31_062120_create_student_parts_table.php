<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_parts', function (Blueprint $table) {
            $table->id();
            $table->integer('part_number');
            $table->integer('type'); // 1 - registration fee  2- school fee
            $table->double('amount');
            $table->date('payment_time')->nullable();
            $table->boolean('paid')->default(0);
            
            $table->integer('payment_type')->nullable(); // check -  bank transferer

            $table->integer('check_number')->nullable(); // check -  bank transferer
            $table->string('check_owner')->nullable(); // check -  bank transferer

            $table->string('payment_image')->nullable(); // check -  bank transferer
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_parts');
    }
}
