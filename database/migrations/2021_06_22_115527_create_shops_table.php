<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->string('poblacion', 255);
            $table->string('telefono', 32);
            $table->timestamps();
        });
        // crear el campo shopp_id en la tabla tasks
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id')->nullable()->after('user_id');
            $table->foreign('shop_id')->references('id')->on('shops')->onUpdate('cascade')->onDelete('cascade');
        });   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Eliminar la clave foranea de la tabla tasks
        Schema::table('tasks', function (Blueprint $table){
            $table->dropForeign('tasks_shop_id_foreign');
            $table->dropColumn('shop_id');
        });
        Schema::dropIfExists('shops');
    }
}
