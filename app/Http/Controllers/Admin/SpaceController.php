<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use App\Space;
use App\Http\Requests\Admin\SpaceRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\ReorderRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;

class SpaceController extends AdminController {

    public function __construct()
    {
        view()->share('type', 'space');
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // Show the page
        return view('admin.spaces.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
       // Show the page
        return view('admin/spaces/create_edit');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(SpaceRequest $request)
	{
      $space = new Space($request->all());
      $space->save();
	}

	public function edit(Space $space)
	{
        return view('admin/spaces/create_edit', compact('space'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(SpaceRequest $request, Space $space)
	{
        $space->update($request->all());
	}

    public function delete(Space $space)
    {
        // Show the page
        return view('admin/spaces/delete', compact('space'));
    }

    public function destroy(Space $space)
    {
        $space->delete();
    }

    public function data()
    {
        $spaces = Space::orderBy('spaces.name', 'ASC')
      			->get()
      			->map(function ($space) {
      				return [
      					'id' => $space->id,
      					'name' => $space->name,
                'size_x' => $space->size_x,
                'size_y' => $space->size_y
      				];
      			});

            return Datatables::of($spaces)
                ->add_column('actions', '<a href="{{{ url(\'admin/space/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                        <a href="{{{ url(\'admin/space/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                        <input type="hidden" name="row" value="{{$id}}" id="row">')
                ->make();
    }

}
