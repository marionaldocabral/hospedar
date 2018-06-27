<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Colaboradors.
 *
 * @author  The scaffold-interface created at 2018-06-20 11:24:33pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Colaboradors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('colaboradors',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('nome');
        
        $table->String('telefone');
        
        $table->String('funcao');
        
        $table->integer('user_id')->nullable();
        
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
        Schema::drop('colaboradors');
    }
}
