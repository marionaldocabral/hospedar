<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reserva.
 *
 * @author  The scaffold-interface created at 2018-07-08 02:56:55pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Reserva extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'reservas';
	
}
