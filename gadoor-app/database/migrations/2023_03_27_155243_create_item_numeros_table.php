<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemNumerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_numeros', function (Blueprint $table) {
            $table->id();
            $table->string('id_item');
            $table->string('placeholder')->nullable();
            $table->string('limite_min');
            $table->string('limite_max');
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
        Schema::dropIfExists('item_numeros');
    }
}
