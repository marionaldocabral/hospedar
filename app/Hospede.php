<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Hospede.
 *
 * @author  The scaffold-interface created at 2018-06-20 11:28:42pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Hospede extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'hospedes';

	
}
