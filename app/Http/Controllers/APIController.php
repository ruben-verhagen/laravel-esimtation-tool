<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Space;
use App\Item;

class APIController extends Controller {

  public function __construct()
  {
      view()->share('type', 'space');
  }

	public function space()
	{
      $spaces = Space::orderBy('name', 'ASC')->get();
      return response()->json(array('data' => $spaces));
	}

  public function item()
  {
      $items = Item::orderBy('name', 'ASC')->get();
      return response()->json(array('data' => $items));
  }

}
