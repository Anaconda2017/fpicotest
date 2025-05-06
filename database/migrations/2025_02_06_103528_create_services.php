<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('en_service_title')->nullable();
            $table->string('ar_service_title')->nullable();

            $table->string('en_service_text')->nullable();
            $table->string('ar_service_text')->nullable();

            $table->string('en_slug')->nullable();
            $table->string('ar_slug')->nullable();

            $table->string('en_meta_title')->nullable();
            $table->string('ar_meta_title')->nullable();
            $table->text('en_meta_text')->nullable();
            $table->text('ar_meta_text')->nullable();

            $table->string('service_type')->nullable();

            $table->string('main_image')->nullable();
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
        Schema::dropIfExists('services');
    }
}
