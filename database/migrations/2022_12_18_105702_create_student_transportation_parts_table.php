<?php

use App\Models\StudentTransportation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTransportationPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_transportation_parts', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->integer('payment_type')->nullable();
            $table->string('check_owner')->nullable();
            $table->integer('check_number')->nullable();
            $table->string('attachment')->nullable();
            $table->boolean('paid')->default(0);
            $table->foreignIdFor(StudentTransportation::class)->constrained('student_transportation')->onDelete('cascade');
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
        Schema::dropIfExists('student_transportation_parts');
    }
}
