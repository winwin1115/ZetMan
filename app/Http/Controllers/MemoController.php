<?php

namespace App\Http\Controllers;

use App\Memo;
use App\Staff;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
{
    /**
     * 一覧
     */
    public function index (Request $request)
    {
        $params[] = '';
        $params['user_id'] = AuthService::getAuthUser()->id;
        if(isset($request['work_on'])) {
            $params['work_on_from'] = $request['work_on'];
        }
        $memo = new Memo();
        $memos = $memo->search($params)->orderBy('work_on', 'asc')->get();
        return view('memo.index', compact('memos'));
    }

    /**
     * 詳細
     */
    public function show($id)
    {
        return view('memo.show', compact('id'));
    }

    /**
     * 追加
     */
    public function add()
    {
        $user_id = Auth::id();
        $staffs = Staff::where('user_id', $user_id)->get();
        return view('memo.add', compact('staffs'));
    }

    /**
     * 登録
     */
    public function store(Request $request)
    {
        // 登録処理
        $memo = new Memo;
        $memo->user_id = Auth::id();
        $memo->staff_id = $request->staff_id;
        $memo->work_on = $request->work_on;
        $memo->time_type = $request->time_type;
        $memo->remarks = $request->remarks;
        $memo->save();
        // リダイレクト処理
        return redirect()->route('memo.index');
    }

    /**
     * 編集
     */
    public function edit($id)
    {
        $user_id = Auth::id();
        $memo = Memo::find($id);
        $staffs = Staff::where('user_id', $user_id)->get();
        // $memo = ChargeRemark::find($id)->member();
        // $memo = ChargeRemark::find($id)->with('members');
        return view('memo.edit', compact('id', 'memo', 'staffs'));
    }

    /**
     * 更新
     */
    public function update($id, Request $request)
    {
        $memo = Memo::find($id);
        $memo->staff_id = $request->staff_id;
        $memo->work_on = $request->work_on;
        $memo->time_type = $request->time_type;
        $memo->remarks = $request->remarks;
        $memo->save();
        return redirect()->route('memo.index');
        // $flight->name = $request->name;
        // $flight->save();
        // $memo = ChargeRemark::find($id);
        // return view('memo.edit', compact('id', 'memo'));
    }
}
