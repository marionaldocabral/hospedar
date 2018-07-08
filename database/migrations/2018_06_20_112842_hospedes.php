<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Hospedes.
 *
 * @author  The scaffold-interface created at 2018-06-20 11:28:43pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Hospedes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('hospedes',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('codigo');
        
        $table->String('nome');
        
        $table->String('cargo');
        
        $table->String('local');
        
        $table->String('telefone')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('hospedes');
    }
}
