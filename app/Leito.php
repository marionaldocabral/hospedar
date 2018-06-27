<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Leito.
 *
 * @author  The scaffold-interface created at 2018-06-20 11:32:08pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Leito extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'leitos';

	
}
