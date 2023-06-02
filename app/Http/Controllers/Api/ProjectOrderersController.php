<?php

namespace App\Http\Controllers\Api;

use App\Orderer;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Resources\OrdererResource;
use App\Http\Resources\ProjectOrdererDetailResource;

/**
 * 元請け情報を扱うAPIのController
 */
class ProjectOrderersController extends ApiBaseController
{
    /**
     * 一覧取得
     *
     * @param Request $request
     * @return json
     */
    public function index(Request $request)
    {
        $user_id = AuthService::getAuthUser()->id;
        return new OrdererResource(Orderer::search($request->all(), $user_id)->get());
    }

    /**
     * 詳細
     *
     * @param integer $id
     * @return json
     */
    public function show($id)
    {
        return new ProjectOrdererDetailResource(Orderer::find($id));
    }

    /**
     * 削除
     *
     * @param integer $id
     * @return json
     */
    public function destroy($id)
    {
        Orderer::destroy($id);
        return response()->noContent();
    }
}
