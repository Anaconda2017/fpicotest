<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChairmanMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chairman_message', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('main_image')->nullable();
            $table->string('en_name')->nullable();
            $table->string('ar_name')->nullable();
            $table->string('en_small_title')->nullable();
            $table->string('ar_small_title')->nullable();
            $table->string('en_title')->nullable();
            $table->string('ar_title')->nullable();
            $table->text('en_text')->nullable();
            $table->text('ar_text')->nullable();
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
        Schema::dropIfExists('chairman_message');
    }
}
