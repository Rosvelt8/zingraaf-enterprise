<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TasksReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tasks_report', function (Blueprint $table) {
            $table->bigIncrements('idtask_rep');
            $table->text('description');
            $table->foreignId('task_ass')
                ->constrained('tasks_assign', 'idtask_ass')
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
        Schema::dropIfExists('tasks_report');
    }
}
