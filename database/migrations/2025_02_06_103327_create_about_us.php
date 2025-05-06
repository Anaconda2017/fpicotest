<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutUs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('en_stand_for_title')->nullable();
            $table->string('ar_stand_for_title')->nullable();
            $table->text('en_stand_for_text')->nullable();
            $table->text('ar_stand_for_text')->nullable();

            $table->string('en_mission_title')->nullable();
            $table->string('ar_mission_title')->nullable();
            $table->text('en_mission_text')->nullable();
            $table->text('ar_mission_text')->nullable();

            $table->string('en_vision_title')->nullable();
            $table->string('ar_vision_title')->nullable();
            $table->text('en_vision_text')->nullable();
            $table->text('ar_vision_text')->nullable();

            $table->text('en_main_text')->nullable();
            $table->text('ar_main_text')->nullable();

            $table->string('en_meta_title')->nullable();
            $table->string('ar_meta_title')->nullable();
            $table->text('en_meta_text')->nullable();
            $table->text('ar_meta_text')->nullable();

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
        Schema::dropIfExists('about_us');
    }
}
