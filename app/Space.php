<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{

	protected $guarded  = array('id');

	/**
	 * The rules for email field, automatic validation.
	 *
	 * @var array
	*/
	private $rules = array(
			'name' => 'required|min:3'
	);

}
