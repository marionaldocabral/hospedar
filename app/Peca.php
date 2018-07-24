<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Peca.
 *
 * @author  The scaffold-interface created at 2018-07-21 01:20:41am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Peca extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'pecas';

	
}
