<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_marks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_term_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('mark')->unsigned();
            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects');

            $table->foreign('student_term_id')
                ->references('id')
                ->on('student_terms')
                ->onDelete('cascade');

            $table->unique([
                'student_term_id',
                'subject_id',
            ],
                'uk_student_marks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_marks');
    }
}
