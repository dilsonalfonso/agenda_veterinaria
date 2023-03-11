<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mascotas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotas', function(Blueprint $table){
            $table->id();
            $table->string('nomb_masc',10);
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('tipo_mascota_id');
            $table->foreign('tipo_mascota_id')->references('id')->on('tipo_mascota')->onDelete('cascade')->onUpdate('cascade');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mascotas');
    }
}
