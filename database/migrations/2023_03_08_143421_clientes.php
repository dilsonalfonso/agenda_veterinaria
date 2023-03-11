<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Clientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function(Blueprint $table){
            $table->id();
            $table->string('cedu_clie',10)->unique();
            $table->string('nomb_clie',40);
            $table->string('apel_clie',40);
            $table->string('celu_clie',10);
            $table->string('emai_clie');
            $table->timestamp('deleted_at')->nullable();
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
        Schema::drop('clientes');
    }
}
