<?php

namespace App\Http\Controllers;

use App\Charge;
use App\Staff;
use App\Jobs\SendSms;
use Illuminate\Http\Request;
use App\Services\SmsService;
use App\Services\AuthService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ChargeStoreRequest;
use App\Http\Requests\ChargeUpdateRequest;
use App\Http\Requests\ChargePasswordUpdateRequest;
use \Datetime;

class ChargesController extends Controller
{

    /**
     * 一覧
     *
     * @param Request $request
     * @return json
     */
    public function index()
    {
        $user_id = AuthService::getAuthUser()->id;
        $charges = Charge::where('user_id', $user_id)->get();
        return view('charges.index', compact('charges'));
    }

    /**
     * 詳細
     *
     * @param Request $request
     * @return json
     */
    public function show($id)
    {
        $charge = Charge::find($id);
        if ($charge->user_id !== AuthService::getAuthUser()->id) {
            return redirect()->back();
        }
        return view('charges.detail', compact('id', 'charge'));
    }

    /**
     * 新規追加
     *
     * @param Request $request
     * @return json
     */
    public function add()
    {
        $user_id = AuthService::getAuthUser()->id;
        return view('charges.add', compact('user_id'));
    }

    /**
     * 編集
     *
     * @param Request $request
     * @return json
     */
    public function edit($id)
    {
        $charge = Charge::find($id);
        if ($charge->user_id !== AuthService::getAuthUser()->id) {
            return redirect()->back();
        }
        return view('charges.edit', compact('charge'));
    }

    /**
     * 作成
     *
     * @param Request $request
     * @return json
     */
    public function store(ChargeStoreRequest $request)
    {
        // バリデーション値を取得する
        $validated = $request->validated();
        // dd($validated['password']);
        // ユーザーIDに不正がないか確認
        if($validated['user_id'] != AuthService::getAuthUser()->id) {
            $error = 'ユーザーIDに不正がありました。';
            return back()->withErrors($error)->withInput();
        }

        // パスワードのハッシュ化
        $validated['password'] = Hash::make($validated['password']);

        // 2テーブル以上の登録or更新がある為、トランザクションを張る
        DB::beginTransaction();
        try {
            // 担当者を登録する
            $charge = new Charge();
            // $charge_sort_id = Charge::where('user_id', $validated['user_id'])->get()->count() + 2;
            // if(Charge::where('user_id', $validated['user_id'])->get()->count() == 0) {
            //     $charge_sort_id = 1;
            // }
            $charge->create([
                'user_id'   => $validated['user_id'],
                'phone'     => $validated['phone'],
                'name'      => $validated['name'],
                'password'  => $validated['password'],
                'edit_type' => $validated['edit_type'],
                // 'show_order'=> $charge_sort_id
            ]);
            $charge_id = DB::getPdo()->lastInsertId();

//             // ショートメッセージを送る機能
//             $type    = config('const.sms.type.charge_login');
//             $message =
//             $validated['name'].' 様

// CATTOBIから招待が届きました。

// ※本登録完了後にホーム画面もしくはブックマークに登録してください。ログインする際に利用します。

// ログインURL：'.route('charge.login').'
// ログインID：'.$validated['phone'].'
// パスワード：'.$request['password'];
            // SmsService::sendToCharge($charge_id, $type, $message);

            if ($validated['edit_type'] == 0) {

                $staff_id = -1;
                // IF $validated['edit_type'] == editor
                $staff = new Staff();
                $sort = Staff::whereNotNull("sort")->max('sort');
                $staff->create([
                    'user_id'   => $validated['user_id'],
                    'charge_id'   => $charge_id,
                    'name'      => $validated['name'],
                    'sort'      => $sort + 1,
                ]);
            }


            // トランザクションを通過してDBに登録
            DB::commit();

            // ページ遷移
            return redirect()->route('charges.index')->with('success-message', '担当者を登録しました。');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::debug($e);
            $error = 'スタッフ情報の登録に失敗しました。';
            return back()->withErrors($error)->withInput();
        }
    }

    /**
     * 更新
     *
     * @param Request $request
     * @return json
     */
    public function update(ChargeUpdateRequest $request)
    {
        // バリデーション値を取得する
        $validated = $request->validated();

        // 担当者情報を取得する
        $charge = Charge::find($request->charge_id);
        $charge_edit_type = $charge['edit_type'];
        $charge_edit_type_to = $validated['edit_type'];
        $charge->fill($validated);
        $charge->save();


        // $sort = Member::get()->count();
        // update Member table info
        if ($charge_edit_type == config('const.charge.edit_type.edit') && $charge_edit_type_to == config("const.charge.edit_type.view")) {
            // DELETE
            $staff = Staff::where('charge_id', $charge['id'])->delete();
        } else if ($charge_edit_type_to == config('const.charge.edit_type.edit') && $charge_edit_type == config("const.charge.edit_type.view")) {
            // Plus sort
            $staff = Staff::where('charge_id', $charge['id'])->first();
            if ($staff) {
                $staff->fill($validated);
                $staff->save();
                $staff->restore();
            } else {
                $staff1 = new Staff();
                $validated['user_id'] = $charge['id'];
                $validated['charge_id'] = 0;
                $validated['sort'] = 1;
                $staff1->create($validated);
            }
        } else {
            $staff = Staff::where('charge_id', $charge['id'])->first();
            if ($staff) {
                $staff->fill($validated);
                $staff->save();
            } else {
                $staff1 = new Staff();
                $validated['user_id'] = $charge['id'];
                $validated['charge_id'] = 0;
                $validated['sort'] = 1;
                $staff1->create($validated);
            }
        }

        if (\Auth::guard('charge')->check()) {
            return redirect()->route('charge.charges.show', $charge->id)->with('success-message', '担当者情報を更新しました。');
        }
        // return redirect()->route('charges.edit', $charge->id)->with('success-message', '担当者情報を更新しました。');
        return redirect()->route('charges.show', $charge->id)->with('success-message', '担当者情報を更新しました。');
    }

    /**
     * 担当者情報_パスワード更新処理
     *
     * @return void
     */
    public function updatePassword(ChargePasswordUpdateRequest $request, $id)
    {
        // ユーザーでログインしている場合の処理
        $charge = Charge::find($id);
        $charge->password = Hash::make($request->password);
        $charge->save();
        return redirect()->route('charges.show', $charge->id)->with('success-message', 'パスワードを更新しました。');
    }

    /**
     * 担当者情報_編集_パスワード画面へ遷移
     *
     * @return void
     */
    public function editPassword($id) {
        return view('charges.editPassword', compact('id'));
    }
}
