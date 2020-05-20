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
            $table->string('entry_by')->nullable();
            $table->string('nik')->nullable();
            $table->timestamp('time_from')->nullable();
            $table->timestamp('time_until')->nullable();
            $table->string('description');
            $table->integer('duration')->nullable();
            $table->string('status',1);
            $table->date('insertDate');
            $table->string('location')->nullable();
            $table->string('approved_by',8);
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
