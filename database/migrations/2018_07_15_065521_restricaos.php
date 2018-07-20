<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Restricaos.
 *
 * @author  The scaffold-interface created at 2018-07-15 06:55:21pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Restricaos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('restricaos',function (Blueprint $table){

        $table->increments('id');
        
        $table->integer('hospede_id')->unsigned();
        
        $table->String('tipo');

        $table->foreign('hospede_id')
                    ->references('id')
                    ->on('hospedes')
                    ->onUpdate('restrict')
                    ->onDelete('cascade');
        
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
        Schema::drop('restricaos');
    }
}
