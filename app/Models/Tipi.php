<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipi extends Model
{
    use HasFactory;

        /**
	* Get the route key for the model.
	*
	* @return string
	*/
	public function getRouteKeyName()
	{
	    return 'type';
	}
}
