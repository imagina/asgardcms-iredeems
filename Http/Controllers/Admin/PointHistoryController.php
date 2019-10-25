<?php

namespace Modules\Iredeems\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iredeems\Entities\PointHistory;
use Modules\Iredeems\Http\Requests\CreatePointHistoryRequest;
use Modules\Iredeems\Http\Requests\UpdatePointHistoryRequest;
use Modules\Iredeems\Repositories\PointHistoryRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class PointHistoryController extends AdminBaseController
{
    /**
     * @var PointHistoryRepository
     */
    private $pointhistory;

    public function __construct(PointHistoryRepository $pointhistory)
    {
        parent::__construct();

        $this->pointhistory = $pointhistory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$pointhistories = $this->pointhistory->all();

        return view('iredeems::admin.pointhistories.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iredeems::admin.pointhistories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePointHistoryRequest $request
     * @return Response
     */
    public function store(CreatePointHistoryRequest $request)
    {
        $this->pointhistory->create($request->all());

        return redirect()->route('admin.iredeems.pointhistory.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iredeems::pointhistories.title.pointhistories')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PointHistory $pointhistory
     * @return Response
     */
    public function edit(PointHistory $pointhistory)
    {
        return view('iredeems::admin.pointhistories.edit', compact('pointhistory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PointHistory $pointhistory
     * @param  UpdatePointHistoryRequest $request
     * @return Response
     */
    public function update(PointHistory $pointhistory, UpdatePointHistoryRequest $request)
    {
        $this->pointhistory->update($pointhistory, $request->all());

        return redirect()->route('admin.iredeems.pointhistory.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iredeems::pointhistories.title.pointhistories')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PointHistory $pointhistory
     * @return Response
     */
    public function destroy(PointHistory $pointhistory)
    {
        $this->pointhistory->destroy($pointhistory);

        return redirect()->route('admin.iredeems.pointhistory.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iredeems::pointhistories.title.pointhistories')]));
    }
}
