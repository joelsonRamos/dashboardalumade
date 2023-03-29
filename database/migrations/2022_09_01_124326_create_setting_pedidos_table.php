<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pedido')->unsigned();
            $table->string('id_produto')->nullable();
            $table->string('id_etapa')->nullable();
            $table->string('id_campo')->nullable();
            $table->string('id_item')->nullable();
            $table->string('item')->nullable();
            $table->foreign('id_pedido')->references('id')->on('pedidos');
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
        Schema::dropIfExists('setting_pedidos');
    }
}
