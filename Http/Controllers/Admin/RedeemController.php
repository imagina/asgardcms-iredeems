<?php

namespace Modules\Iredeems\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iredeems\Entities\Redeem;
use Modules\Iredeems\Http\Requests\CreateRedeemRequest;
use Modules\Iredeems\Http\Requests\UpdateRedeemRequest;
use Modules\Iredeems\Repositories\RedeemRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class RedeemController extends AdminBaseController
{
    /**
     * @var RedeemRepository
     */
    private $redeem;

    public function __construct(RedeemRepository $redeem)
    {
        parent::__construct();

        $this->redeem = $redeem;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$redeems = $this->redeem->all();

        return view('iredeems::admin.redeems.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iredeems::admin.redeems.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRedeemRequest $request
     * @return Response
     */
    public function store(CreateRedeemRequest $request)
    {
        $this->redeem->create($request->all());

        return redirect()->route('admin.iredeems.redeem.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iredeems::redeems.title.redeems')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Redeem $redeem
     * @return Response
     */
    public function edit(Redeem $redeem)
    {
        return view('iredeems::admin.redeems.edit', compact('redeem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Redeem $redeem
     * @param  UpdateRedeemRequest $request
     * @return Response
     */
    public function update(Redeem $redeem, UpdateRedeemRequest $request)
    {
        $this->redeem->update($redeem, $request->all());

        return redirect()->route('admin.iredeems.redeem.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iredeems::redeems.title.redeems')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Redeem $redeem
     * @return Response
     */
    public function destroy(Redeem $redeem)
    {
        $this->redeem->destroy($redeem);

        return redirect()->route('admin.iredeems.redeem.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iredeems::redeems.title.redeems')]));
    }
}
