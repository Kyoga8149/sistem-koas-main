<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')
                ->constrained();
            $table->string('full_name');
            $table->string('student_number');
            $table->string('email')
                ->nullable();
            $table->string('phone')
                ->nullable();
            $table->string('notes')
                ->nullable();
            $table->string('photo_url')->nullable();
            $table->string('file_2_url')->nullable();
            $table->string('file_3_url')->nullable();
            $table->string('file_4_url')->nullable();
            $table->string('file_5_url')->nullable();
            $table->string('file_6_url')->nullable();

            $table->string('status');
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
        Schema::dropIfExists('students');
    }
};
