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
        Schema::create('station_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')
                ->constrained();
            $table->foreignId('station_id')
                ->constrained();
            $table->foreignId('teacher_id')
                ->nullable()
                ->constrained();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('station_groups');
    }
};
