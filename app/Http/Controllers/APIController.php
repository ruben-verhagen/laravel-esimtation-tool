<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Space;
use App\Item;
use App\Estimation;
use App\EstimationSpace;
use App\EstimationItem;

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

  public function saveEstimation()
  {
      $spaces = Input::get('spaces');
      $estimation = new Estimation();
      $result = $estimation->save();
      if ($result) {
        foreach ($spaces as $space) {
            $est_space = new EstimationSpace();
            $est_space->estimation_id = $estimation->id;
            $est_space->name = $space['name'];
            $est_space->size_x = $space['size_x'];
            $est_space->size_y = $space['size_y'];
            $est_space->save();
            foreach ($space['items'] as $item) {
              $est_item = new EstimationItem();
              $est_item->space_id = $est_space->id;
              if (isset($item['obj'])) {
                $est_item->name = $item['obj']['name'];
                $est_item->type = $item['obj']['type'];
                $est_item->cost = $item['obj']['cost'];
                $est_item->price = $item['obj']['price'];
              }
              $est_item->save();
            }
        }
      }
      return response()->json(array('estimation_id' => $estimation->id));
  }
}
