<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimation extends Model
{

	protected $guarded  = array('id');

	private $rules = array(

	);

	public function spaces()
	{
		return $this->hasMany(EstimationSpace::class, 'estimation_id');
	}

}
