<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Leitos.
 *
 * @author  The scaffold-interface created at 2018-06-20 11:32:08pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Leitos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('leitos',function (Blueprint $table){

        $table->increments('id');
        
        $table->integer('hospede_id')->nullable();
        
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
        Schema::drop('leitos');
    }
}
