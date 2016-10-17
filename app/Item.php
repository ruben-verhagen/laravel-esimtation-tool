<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

	protected $guarded  = array('id');

	/**
	 * The rules for email field, automatic validation.
	 *
	 * @var array
	*/
	private $rules = array(
			'name' => 'required|min:3',
			'type' => 'required|min:3',
			'cost' => 'required|numeric|min:0',
			'price' => 'required|numeric|min:0'
	);

}
