<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Colaborador.
 *
 * @author  The scaffold-interface created at 2018-06-20 11:24:33pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Colaborador extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'colaboradors';

	
}
