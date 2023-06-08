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
        Schema::create('portfolio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->longText('short_content', 255);
            $table->longText('content');
            $table->string('client_name', 255);
            $table->string('client_company', 255);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('web_site', 255);
            $table->string('cost', 255);
            $table->string('client_content', 255);
            $table->string('categories', 255);

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
        Schema::dropIfExists('portfolio');
    }
};
