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
        Schema::create('slider', function (Blueprint $table) {
            $table->increments('id');
            $table->string('heading',255);
            $table->longText('content');
            $table->string('button1_text',255)->nullable();
            $table->string('button1_url',255)->nullable();
            $table->string('button2_text',255)->nullable();
            $table->string('button2_url',255)->nullable();
            $table->string('position');
            $table->string('img',255);
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
        Schema::dropIfExists('slider');
    }
};
