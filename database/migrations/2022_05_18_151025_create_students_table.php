<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('teacher_id')->unsigned();
            $table->string('name', 255);
            $table->integer('age')->unsigned();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->timestampTz('created_at')->useCurrent();
            $table->timestampTz('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers');

            $table->unique([
                'teacher_id',
                'name',
                'age',
                'gender'
            ],
                'uk_students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
