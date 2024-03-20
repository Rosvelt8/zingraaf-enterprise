<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Enterprise extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('enterprises', function (Blueprint $table) {
            $table->bigIncrements('ident');
            $table->string('name', 100);
            $table->string('contact', 100);
            $table->string('address', 100);
            $table->time('open_hours');
            $table->time('close_hours');
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
        //
        Schema::dropIfExists('enterprises');

    }
}
