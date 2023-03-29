<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listas', function (Blueprint $table) {
            $table->id();
            $table->string('id_item');
            $table->string('nome_lista')->nullable();
            $table->string('image')->nullable();
            $table->string('tipo_acao')->nullable();
            $table->string('visualizacao');
            $table->string('acao')->nullable();
            $table->string('status')->default(true);
            $table->string('deletado');
            $table->string('user');
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
        Schema::dropIfExists('listas');
    }
}
