<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Movimentacao.
 *
 * @author  The scaffold-interface created at 2018-06-20 11:35:06pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Movimentacao extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'movimentacaos';

	
}
