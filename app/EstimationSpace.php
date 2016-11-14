<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstimationSpace extends Model
{

	protected $guarded  = array('id');

	private $rules = array(

	);

	public function items()
	{
		return $this->hasMany(EstimationItem::class, 'space_id');
	}

}
