<?php

namespace Modules\Iredeems\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iredeems\Entities\Point;
use Modules\Iredeems\Http\Requests\CreatePointRequest;
use Modules\Iredeems\Http\Requests\UpdatePointRequest;
use Modules\Iredeems\Repositories\PointRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class PointController extends AdminBaseController
{
    /**
     * @var PointRepository
     */
    private $point;

    public function __construct(PointRepository $point)
    {
        parent::__construct();

        $this->point = $point;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$points = $this->point->all();

        return view('iredeems::admin.points.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iredeems::admin.points.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePointRequest $request
     * @return Response
     */
    public function store(CreatePointRequest $request)
    {
        $this->point->create($request->all());

        return redirect()->route('admin.iredeems.point.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iredeems::points.title.points')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Point $point
     * @return Response
     */
    public function edit(Point $point)
    {
        return view('iredeems::admin.points.edit', compact('point'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Point $point
     * @param  UpdatePointRequest $request
     * @return Response
     */
    public function update(Point $point, UpdatePointRequest $request)
    {
        $this->point->update($point, $request->all());

        return redirect()->route('admin.iredeems.point.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iredeems::points.title.points')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Point $point
     * @return Response
     */
    public function destroy(Point $point)
    {
        $this->point->destroy($point);

        return redirect()->route('admin.iredeems.point.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iredeems::points.title.points')]));
    }
}
