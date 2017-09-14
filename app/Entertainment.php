<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entertainment extends Model
{
	protected $table = 'options';

	protected $fillable = ['description','price'];

	public function trip()
	{

		return $this->belongsTo('\App\Trip');

	}
}
