<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('identifiant', 12)->unique();
            $table->string('name', 100);
            $table->string('surname', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone', 20);
            $table->date('employee_date');
            $table->enum('role', ['AD', 'EM', 'DM', 'GM'])->comment('Administrator Employeee Division Manager General Manager');
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('division')
                ->constrained('divisions', 'iddiv')
                ->onDelete('cascade')
                ->onUpdate('cascade')->nullable();
            $table->foreignId('enterprise')
                ->constrained('enterprises', 'ident')
                ->onDelete('cascade')
                ->onUpdate('cascade')->nullable();
            $table->foreignId('category')
                ->constrained('categories_employee', 'idcat')
                ->onDelete('cascade')
                ->onUpdate('cascade')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
