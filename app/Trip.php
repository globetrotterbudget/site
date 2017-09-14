<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $table = 'trips';

    protected $fillable = ['trip_name', 'locations', 'number_of_people', 'number_of_days', 'accomodations', 'transportation', 'food'];
    
    public function cost()
    {
 
    	return $this->hasOne('\App\Cost');

	}
	public function options()
	{

		return $this->hasMany('\App\Entertainment');

	}

}
