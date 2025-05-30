<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArregationSystem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arregation_system', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('en_title')->nullable();
            $table->string('ar_title')->nullable();
            $table->text('en_text')->nullable();
            $table->text('ar_text')->nullable();
            $table->integer('active_status')->nullable();
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
        Schema::dropIfExists('arregation_system');
    }
}
