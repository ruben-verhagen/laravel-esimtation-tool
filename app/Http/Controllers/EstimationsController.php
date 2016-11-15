<?php namespace App\Http\Controllers;

use App\Estimation;

class EstimationsController extends Controller {

  public function show($estimation)
	{
    return view('pages.estimation', compact('estimation'));
	}

}
