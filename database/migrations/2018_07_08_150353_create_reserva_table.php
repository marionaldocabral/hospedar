<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('leito_id');            
            $table->string('hospede_codigo');
            $table->string('hospede_nome');
            $table->string('hospede_cargo');
            $table->string('hospede_local');
            $table->string('hospede_telefone');
            $table->string('hospede_email');
            $table->boolean('diabetes')->default(0);
            $table->boolean('pressao')->default(0);
            $table->boolean('epilepsia')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
