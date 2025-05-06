<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contat_first_phone')->nullable();
            $table->string('contact_second_phone')->nullable();
            $table->string('en_address')->nullable();
            $table->string('ar_address')->nullable();
            $table->string('face_link')->nullable();
            $table->string('insta_link')->nullable();
            $table->string('tweet_link')->nullable();
            $table->string('snap_link')->nullable();
            $table->string('watus_link')->nullable();
            $table->string('linked_link')->nullable();
            $table->string('main_email')->nullable();
            $table->text('map_link')->nullable();
            $table->text('contact_text')->nullable();

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
        Schema::dropIfExists('contact_information');
    }
}
