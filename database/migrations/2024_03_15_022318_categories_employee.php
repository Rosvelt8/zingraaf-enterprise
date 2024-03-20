<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoriesEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('categories_employee', function (Blueprint $table) {
            $table->bigIncrements('idcat');
            $table->string('entitle', 100);
            $table->string('hour_rate');
            $table->foreignId('enterprise')
                ->constrained('enterprises', 'ident')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('divisions');
    }
}
