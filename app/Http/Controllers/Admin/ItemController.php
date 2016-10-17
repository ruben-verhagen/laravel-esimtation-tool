<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use App\Item;
use App\Http\Requests\Admin\ItemRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\ReorderRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;

class ItemController extends AdminController {

    private $item_types = array(
      'labor' => 'Labor',
      'material' => 'Material'
    );
    public function __construct()
    {
        view()->share('type', 'item');
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // Show the page
        return view('admin.items.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
      $item_types = $this->item_types;
       // Show the page
        return view('admin/items/create_edit', compact('item_types'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ItemRequest $request)
	{
      $item = new Item($request->all());
      $item->save();
	}

	public function edit(Item $item)
	{
        $item_types = $this->item_types;
        return view('admin/items/create_edit', compact('item', 'item_types'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ItemRequest $request, Item $item)
	{
        $item->update($request->all());
	}

    public function delete(Item $item)
    {
        // Show the page
        return view('admin/items/delete', compact('item'));
    }

    public function destroy(Item $item)
    {
        $item->delete();
    }

    public function data()
    {
        $items = Item::orderBy('items.name', 'ASC')
      			->get()
      			->map(function ($item) {
      				return [
      					'id' => $item->id,
      					'name' => $item->name,
                'type' => $this->item_types[$item->type],
                'cost' => $item->cost,
                'price' => $item->price
      				];
      			});

            return Datatables::of($items)
                ->add_column('actions', '<a href="{{{ url(\'admin/item/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                        <a href="{{{ url(\'admin/item/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                        <input type="hidden" name="row" value="{{$id}}" id="row">')
                ->make();
    }

}
