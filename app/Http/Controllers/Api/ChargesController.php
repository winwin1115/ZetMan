<?php

namespace App\Http\Controllers\Api;

use App\Charge;
use App\Staff;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Resources\ChargeResource;
use App\Http\Resources\ChargeDetailResource;
use App\Http\Controllers\Api\ApiBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * 担当者情報を扱うAPIのController
 */
class ChargesController extends ApiBaseController
{
    /**
     * 一覧取得
     *
     * @param Request $request
     * @return json
     */
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $user_id = AuthService::getAuthUser()->id;
        // $user_id = \Auth::user();
        // return new ChargeResource(Charge::search($request->all(), $user_id)->get());
        $charges = Charge::where('user_id', $user_id)->orderBy('id', 'ASC')->get();
        $staffs = Staff::where('user_id', $user_id)->orderBy('sort', 'ASC')->get();
        // $charges->sortBy(function($charge) {
        //     return $charge->member()->sort;
        // });
        // return new ChargeResource($members);
        return response()->json(["staffs" => (new ChargeResource($staffs)), "charges" => $charges ]);
    }

    /**
     * 詳細
     *
     * @param integer $id
     * @return json
     */
    public function show($id)
    {
        return new ChargeDetailResource(Charge::find($id));
    }

    /**
     * 削除
     *
     * @param integer $id
     * @return json
     */
    public function destroy($id)
    {
        $user_id = AuthService::getAuthUser()->id;
        // $user_id = \Auth::user();
        $charge = Charge::find($id);
        // $charges = Charge::where('user_id', $user_id)->where('show_order', '>', $charge->show_order);
        // $charges->decrement('show_order');
        Charge::destroy($id);
        // $member = Member::where('charge_id', $charge['id'])->first();
        // // if ($members) {
        // //     $members = [];
        // // }
        // if ($member) {
        //     $sort = $member['sort'];
        //     $member->fill([
        //         "sort"=> NULL
        //     ]);
        //     $member->save();
        //     $member->delete();
        //     Member::where('sort', '>', $sort)->decrement('sort');
        // }
        // return response()->noContent();
        return response()->json([
            'user_id' => $member,
        ]);
    }

    public function deleteMember($id)
    {
        Staff::destroy($id);
    }

    /**
     * ソート順更新
     *
     * @param ProjectRequest $request
     * @param integer $id
     * @return json
     */
    public function updateSort(Request $request, $id)
    {
        // // Operating member table
        // $member = Member::find($id);
        // $beforeSort = $request->currentorder - 1;
        // // if(!empty($member)) {
        // //     $beforeSort = $member->sort;
        // // }
        // $afterSort = $request->sort - 1;

        // // 移動元～移動先のソート番号に該当するレコードを全件取得する
        // $members = null;
        // $user_id = AuthService::getAuthUser()->id;
        // if ($afterSort < $beforeSort) {
        //     // 移動元の方が大きければ、全件ソート番号をインクリメント
        //     $members = Member::where('user_id', $user_id)->whereBetween('sort', [$afterSort, $beforeSort]);
        //     if (!empty($members)) {
        //         $members->increment('sort');
        //     }
        // } elseif ($afterSort > $beforeSort) {
        //     // 移動先の方が大きければ、全件ソート番号をデクリメント
        //     $members = Member::where('user_id', $user_id)->whereBetween('sort', [$beforeSort, $afterSort]);
        //     if (!empty($members)) {
        //         $members->decrement('sort');
        //     }
        // }


        // // 移動元のソート番号を移動先ソート番号に更新する
        // if(!empty($member)) {
        //     $member->sort = $afterSort;
        //     $member->save();
        // }

        $beforeSort_fclient = $request->currentorder - 1;
        $afterSort_fclient = $request->sort - 1;
        $user_id = AuthService::getAuthUser()->id;
        // $user_id = 1;
        $members = Staff::where('user_id', $user_id)->orderBy('sort', 'ASC')->get();
        $members_editors = Staff::where('user_id', $user_id)->orderBy('sort', 'ASC')->get();

        $aftersortmember = $members_editors[$afterSort_fclient];
        $beforesortmember = $members_editors[$beforeSort_fclient];

        $aftersort = -1;
        $beforesort = -1;
        for ($i = 0; $i < count($members); $i ++) {
            if ($members[$i]->id == $aftersortmember->id) {
                $aftersort = $i;
            } elseif ($members[$i]->id == $beforesortmember->id) {
                $beforesort = $i;
            }
        }
        // $aftersort = array_search($aftersortmember, $members);
        // $beforesort = array_search($beforesortmember, $members);

        // return response()->json([
        //     'a' => $beforesort,
        //     'b' => $aftersort,
        //     'c' => $beforeSort_fclient,
        //     'd' => $afterSort_fclient,
        // ]);

        $beforeSort = $beforesort;
        $afterSort = $aftersort;
        // If the purpose destination is smaller than starting point
        if ($afterSort !== -1 && $beforeSort !== -1) {
            if ($afterSort < $beforeSort) {
                $sort_before = $members[$afterSort]->sort;
                for ($i = $afterSort; $i < $beforeSort; $i ++) {
                    $members[$i]->sort += 1;
                }
                $members[$beforeSort]->sort = $sort_before;
                foreach ($members as $member) {
                    $member->save();
                }
                // $members->save();
            } elseif ($afterSort > $beforeSort) {
                $sort_before = $members[$afterSort]->sort;
                for ($i = $beforeSort + 1; $i <= $afterSort; $i ++) {
                    $members[$i]->sort -= 1;
                }
                $members[$beforeSort]->sort = $sort_before;
                foreach ($members as $member) {
                    $member->save();
                }
            }
        }

        return response()->noContent()->withHeaders([
            'Cache-Control' => 'no-store',
        ]);

        // $user_id = AuthService::getAuthUser()->id;


        // $activeItem = Member::find($request->currentorder);
        // $passiveItem = Member::find($request->sort);

        // $activeItemSort = $activeItem['sort'];
        // $passiveItemSort = $passiveItem['sort'];
        // // return response()->noContent()->withHeaders([
        // //     'Cache-Control' => 'no-store',
        // // ]);

        // $activeItem->fill([
        //     "sort"=> $passiveItemSort
        // ]);
        // $activeItem->save();
        // $passiveItem->fill([
        //     "sort"=> $activeItemSort
        // ]);
        // $passiveItem->save();
        // return response()->json([
        //     'data'=> [
        //         'a'=> $request->currentorder,
        //         'b'=> $request->sort,
        //         'c'=> $activeItem,
        //         'd'=> $passiveItem,
        //         'e'=> $id,
        //     ],
        // ]);

    }

    /**
     * 作成
     *
     * @param Request $request
     * @return json
     */
    public function store(Request $request)
    {
        // バリデーション値を取得する
        $validated = [
            'name' => $request['name'],
            'password' => $request['password'],
            'phone' => $request['phone'],
            'edit_type' => $request['edit_type'],
        ];

        // Here you have to confirm the below code(This is the same code from controllers/chargesController)
        // The necessary data is reaching from client
        // return response()->json([
        //     'data' => $validated
        // ]);
        // dd($validated['password']);
        // ユーザーIDに不正がないか確認
        // if($validated['user_id'] != AuthService::getAuthUser()->id) {
        //     $error = 'ユーザーIDに不正がありました。';
        //     return back()->withErrors($error)->withInput();
        // }
        $user_id = AuthService::getAuthUser()->id;

        // パスワードのハッシュ化
        $validated['password'] = Hash::make($validated['password']);

        // 2テーブル以上の登録or更新がある為、トランザクションを張る
        DB::beginTransaction();
        try {
            // 担当者を登録する
//             $charge = new Charge();
//             $charge_sort_id = Charge::where('user_id', $user_id)->get()->count() + 2;
//             if(Charge::where('user_id', $user_id)->get()->count() == 0) {
//                 $charge_sort_id = 1;
//             }
//             $charge->create([
//                 'user_id'   => $user_id,
//                 'phone'     => $validated['phone'],
//                 'name'      => $validated['name'],
//                 'password'  => $validated['password'],
//                 'edit_type' => $validated['edit_type'],
//                 'show_order'=> $charge_sort_id
//             ]);
//             $charge_id = DB::getPdo()->lastInsertId();

//             // ショートメッセージを送る機能
//             $type    = config('const.sms.type.charge_login');
//             $message =
//             $validated['name'].' 様

// CATTOBIから招待が届きました。

// ※本登録完了後にホーム画面もしくはブックマークに登録してください。ログインする際に利用します。

// ログインURL：'.route('charge.login').'
// ログインID：'.$validated['phone'].'
// パスワード：'.$request['password'];
//             // SmsService::sendToCharge($charge_id, $type, $message);

            $sort = 0;
            // IF $validated['edit_type'] == editor
            if ( $validated['edit_type'] == config('const.charge.edit_type.edit') ) {
                $staff = new Staff();
                $sort = Staff::whereNotNull("sort")->max('sort');
                $staff->create([
                    'user_id'   => $user_id,
                    'charge_id'   => $user_id,
                    'name'      => $validated['name'],
                    'sort'      => $sort + 1,
                ]);
                // $member = new Member();
                // $sort = Member::get()->count();
                // $member->create([
                //     'user_id'   => $validated['user_id'],
                //     'charge_id' => $charge_id,
                //     'name'      => $validated['name'],
                //     'sort'      => $sort + 1,
                // ]);
            } else if ( $validated['edit_type'] == config('const.charge.edit_type.view') ) {
                $staff = new Staff();
                $sort = Staff::whereNotNull("sort")->max('sort');
                $staff->create([
                    'user_id'   => $user_id,
                    'charge_id'   => $user_id,
                    'name'      => $validated['name'],
                    'sort'      => $sort + 1,
                ]);
            }
            //


            // トランザクションを通過してDBに登録
            DB::commit();

            // ページ遷移
            return response()->json([
                'data' => "success",
                'created_at' => $staff->created_at,
                'id' => $staff->id,
                'name' => $validated['name'],
                'sort' => $sort + 1,
                'updated_at' => $staff->updated_at,
                'user' => $user_id,
            ]);
            // return redirect()->route('charges.show', $charge_id)->with('success-message', '担当者を登録しました。');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::debug($e);
            $error = 'スタッフ情報の登録に失敗しました。';
            // return back()->withErrors($error)->withInput();
            return response()->json([
                'data' => "fail"
            ]);
        }
    }
}
