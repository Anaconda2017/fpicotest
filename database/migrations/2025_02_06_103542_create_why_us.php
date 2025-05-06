<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhyUs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('why_us', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('why_us_number')->nullable();
            $table->string('en_why_us_title')->nullable();
            $table->string('ar_why_us_title')->nullable();
            $table->text('en_why_us_text')->nullable();
            $table->text('ar_why_us_text')->nullable();
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
        Schema::dropIfExists('why_us');
    }
}
