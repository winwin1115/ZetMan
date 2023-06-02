<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Memo;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChargeRemarkRequest;
use App\Http\Resources\ChargeRemarkResource;
use App\Http\Resources\ChargeRemarkDetailResource;

class ChargeRemarksController extends ApiBaseController
{
    /**
     * メモ一覧
     */
    public function index(Request $request)
    {
        return new ChargeRemarkResource(Memo::search($request->all())->get());
    }

    /**
     * メモ詳細
     */
    public function show($id)
    {
        // return new ChargeRemarkResource(ChargeRemark::find($id));
        // return new ChargeRemarkResource(ChargeRemark::where('id', $id)->first());
        // return ChargeRemark::where('id', $id)->first();
        return new ChargeRemarkDetailResource(Memo::find($id));
    }

    /**
     * メモ保存
     */
    public function store(ChargeRemarkRequest $request)
    {
        $chargeRemark = new Memo();
        $chargeId = $request->staff_id;
        if (empty($chargeId)) {
            $charegeId = 0;
        }
        
        // メモの情報を保存する
        $chargeRemark->fill([
            'user_id'   => AuthService::getAuthUser()->id,  // ユーザーID
            'staff_id' => $chargeId,                        // 担当者
            'work_on'   => $request->work_on,               // 日付
            'time_type' => $request->time_type,             // AM・PM・未定
            'remarks'   => $request->remarks                // メモ内容
        ])->save();
        // IDをVueファイルにレスポンス
        return response()->json(['id' => $chargeRemark->id]);
    }

    /**
     * メモ更新
     */
    // public function update(ChargeRemarkRequest $request, $id)
    // {
    //     (ChargeRemarkRequest::findOrFail($id))->fill($request->all())->save();
    public function update(Request $request, $id)
    {
        (ChargeRemark::findOrFail($id))->fill($request->all())->save();
        return response()->noContent();
        // IDをVueファイルにレスポンス
        // return response()->json(['id' => $chargeRemark->id]);
    }

    /**
     * メモ削除
     */
    public function destroy(Memo $chargeRemark)
    {
        $chargeRemark->delete();
        return response()->noContent();
    }

    /**
     * 複数のメモを削除する
     *
     * @param Request $request
     * @return json
     */
    public function destroyByMultiId(Request $request)
    {
        $chargeRemarks = Memo::whereIn('id', $request->ids)->delete();
        return response()->noContent();
    }
}
