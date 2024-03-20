<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TasksAssign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tasks_assign', function (Blueprint $table) {
            $table->bigIncrements('idtask_ass');
            $table->enum('status', ['P','R','S'])->comment("Pending- Realised -Success");
            $table->string('hour_rate');
            $table->foreignId('task')
                ->constrained('tasks', 'idtask')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('user')
                ->constrained('users', 'id')
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
        Schema::dropIfExists('tasks_assign');
    }
}
