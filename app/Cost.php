<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $table = 'costs';

    protected $fillable = ['accom_day_cost', 'accom_cost', 'avg_food_day_cost', 'avg_food_cost', 'avg_trans_day_cost', 'avg_trans_cost'];

    public function trip()
    {
    return $this->belongsTo('\App\Trip');
	}

}
