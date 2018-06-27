<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Movimentacaos.
 *
 * @author  The scaffold-interface created at 2018-06-20 11:35:07pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Movimentacaos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('movimentacaos',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('tipo');
        
        $table->String('data');
        
        $table->String('hora');
        
        $table->integer('hospede_id');
        
        /**
         * Foreignkeys section
         */
        
        
        
        // type your addition here

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('movimentacaos');
    }
}
