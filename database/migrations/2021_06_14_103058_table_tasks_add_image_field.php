<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableTasksAddImageField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function(Blueprint $table){
            //crear el campo imagen en la tabla tasks
            $table->string('imagen', 255)
                    ->after('importance')
                    ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function(Blueprint $table){
            //eliminar el campo imagen en la tabla tasks
            $table->dropColumn('imagen');
        });
    }
}
