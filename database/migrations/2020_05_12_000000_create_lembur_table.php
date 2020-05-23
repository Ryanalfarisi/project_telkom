<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLemburTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembur', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('user_id')->nullable();
            $table->timestamp('time_from')->nullable();
            $table->timestamp('time_until')->nullable();
            $table->string('description');
            $table->date('duration')->nullable();
            $table->string('status',1);
            $table->date('insert_date');
            $table->string('location')->nullable();
            $table->string('approved_id',5);
            $table->string('kpi',5)->nullable();
            $table->string('result',250)->nullable();
            $table->string('approved_user',50)->nullable();
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
        Schema::dropIfExists('lembur');
    }
}
