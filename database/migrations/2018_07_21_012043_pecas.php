<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Pecas.
 *
 * @author  The scaffold-interface created at 2018-07-21 01:20:42am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Pecas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('pecas',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('tipo');

        $table->String('servico');
        
        $table->integer('hospede_id')->unsigned();

        $table->foreign('hospede_id')
                    ->references('id')
                    ->on('hospedes')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('pecas');
    }
}
