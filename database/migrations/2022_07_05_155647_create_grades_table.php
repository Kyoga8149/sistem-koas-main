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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('station_group_id')
                ->constrained();
            $table->foreignId('student_id')
                ->constrained();
            $table->string('competency_target')->nullable();
            $table->string('supervision_level')->nullable();

            $table->date('grade_deadline')->nullable();
            $table->decimal('grade_total', 3, 2)->nullable();
            $table->string('grade_note')->nullable();

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
        Schema::dropIfExists('grades');
    }
};
