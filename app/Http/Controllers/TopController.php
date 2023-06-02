<?php

namespace App\Http\Controllers;

use App\Charge;
use App\Project;
use CarbonCarbon;
use Carbon\Carbon;
use App\Memo;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

/**
 * (ユーザー向け)トップページのController
 */
class TopController extends Controller
{
    /**
     * ルートのルーティング：ログインページへリダイレクト
     *
     * @return void
     */
    public function index()
    {
        return redirect()->route('login');
    }


    public static function getAllDayArrayData($loopAllProjects, $loopAllChargeRemarks, $dates)
    {
		// 日付ごとにループ
		for ($i = 0; $i < count($dates); $i ++) {
			$dates[$i][1] = [];
			$dates[$i][2] = [];
			$dates[$i][0] = [];
			// 案件を配列に組み込む
			foreach ($loopAllProjects as $project) {
                $day = date_format($project->work_on, 'D');
                if($day == "Mon"){
                    $japen_day = "月";
                }elseif($day == "Tue"){
                    $japen_day = "火";
                }elseif($day == "Wed"){
                    $japen_day = "水";
                }elseif($day == "Thu"){
                    $japen_day = "木";
                }elseif($day == "Fri"){
                    $japen_day = "金";
                }elseif($day == "Sat"){
                    $japen_day = "土";
                }else{
                    $japen_day = "日";
                }
                $compare_date = date_format($project->work_on, 'm/d')."(".$japen_day.")";
                if ($compare_date === $dates[$i]['date']) {
					if ($project->time_type === 1) {
						$dates[$i][1]['project'][$project->charge_id] = $project;
					} elseif ($project->time_type === 2) {
						$dates[$i][2]['project'][$project->charge_id] = $project;
					} elseif ($project->time_type === 0) {
						$dates[$i][0]['project'][$project->charge_id] = $project;
					}
				}
			}
			// メモを配列に組み込む
			foreach ($loopAllChargeRemarks as $chargeRemark) {
                $day = date_format($chargeRemark->work_on, 'D');
                if($day == "Mon"){
                    $japen_day = "月";
                }elseif($day == "Tue"){
                    $japen_day = "火";
                }elseif($day == "Wed"){
                    $japen_day = "水";
                }elseif($day == "Thu"){
                    $japen_day = "木";
                }elseif($day == "Fri"){
                    $japen_day = "金";
                }elseif($day == "Sat"){
                    $japen_day = "土";
                }else{
                    $japen_day = "日";
                }
                $compare_date = date_format($chargeRemark->work_on, 'm/d')."(".$japen_day.")";
				if ($compare_date === $dates[$i]['date']) {
					if ($chargeRemark->time_type === 1) {
						$dates[$i][1]['charge_remark'][$chargeRemark->charge_id] = $chargeRemark;
					} elseif ($chargeRemark->time_type === 2) {
						$dates[$i][2]['charge_remark'][$chargeRemark->charge_id] = $chargeRemark;
					} elseif ($chargeRemark->time_type === 0) {
						$dates[$i][0]['charge_remark'][$chargeRemark->charge_id] = $chargeRemark;
					}
				}
			}
		}
		return $dates;
    }


    public static function ttt(&$loopAllProjects, &$loopAllChargeRemarks, &$resultProjects, $date, $timeType, $charges)
    {
        // $loopCount = 0;
        // 該当する案件がなくなるまでループ
        $isFound = true;
        $i = 0;
        $prev_found = false;
        do {
            $i++;
            $lineArray = [];
            $isFound = false;
            // 営業担当者ごとにループ

            foreach ($charges as $charge) {
                // dd('time_type = '.$timeType.', date = '.$date.', charge->id = '.$charge->id);
                // ループ用の案件コレクションおよび営業担当者メモコレクション　を営業担当者IDで検索
                // 見つかったものを抽出し、二次元配列へ格納
                $temp = $loopAllProjects->first(function ($value, $key) use ($charge, $timeType, $date) {
                    return ($value['worker_id'] == $charge->id && $value['charge_id'] !== 0) && ($value['time_type'] == $timeType) && $date->eq($value['work_on']);
                });

                if ($temp) {
                    // 行の配列へ格納
                    $isFound     = true;
                    $lineArray[] = $temp->toArray();
                    // 見つかった要素をコレクションから削除する
                    $loopAllProjects = $loopAllProjects->reject(function ($value) use ($temp) {
                        return $value['id'] == $temp->id;
                    });
                } else {
                    $temp = null;
                    $temp = $loopAllChargeRemarks
                        ->where('charge_id', $charge->id)
                        ->where('time_type', $timeType)
                        ->where('work_on', $date)
                        ->first();
                    if ($temp) {
                        // 行の配列へ格納
                        $isFound     = true;
                        $lineArray[] = $temp;
                        // 見つかった要素をコレクションから削除する
                        $loopAllChargeRemarks = $loopAllChargeRemarks->reject(function ($value) use ($temp) {
                            return $value['id'] == $temp->id;
                        });
                    } else {
                        $lineArray[] = null;
                    }
                }

            }

            if($prev_found == true && $isFound == false)
            return;
            $prev_found = $isFound;

            if ($isFound) {
                $resultProjects[] = $lineArray;

            }else{
                $fake_array = [];
                $fake_date =  $date->format('Y-m-d');

                for($i=0; $i<count($charges); $i++){
                    $fake_array[] = array("work_on"=>$fake_date, "time_type"=>$timeType);
                    // $fake_array[] = null;
                }
                $resultProjects[] = $fake_array;
            }

        } while ($isFound);
        // dd($resultProjects);

        return;
    }

    public static function getProjectArrayData(&$loopAllProjects, &$loopAllChargeRemarks, &$resultProjects, $date, $timeType, $charges)
    {
        // $loopCount = 0;
        // 該当する案件がなくなるまでループ
        do {
            $lineArray = [];
            $isFound = false;
            // 営業担当者ごとにループ
            foreach ($charges as $charge) {
                // dd('time_type = '.$timeType.', date = '.$date.', charge->id = '.$charge->id);
                // ループ用の案件コレクションおよび営業担当者メモコレクション　を営業担当者IDで検索
                // 見つかったものを抽出し、二次元配列へ格納
                $temp = $loopAllProjects->first(function ($value, $key) use ($charge, $timeType, $date) {
                    return ($value['worker_id'] == $charge->id && $value['charge_id'] !== 0) && ($value['time_type'] == $timeType) && $date->eq($value['work_on']);
                });
                if ($temp) {
                    // 行の配列へ格納
                    $isFound     = true;
                    $lineArray[] = $temp;
                    // 見つかった要素をコレクションから削除する
                    $loopAllProjects = $loopAllProjects->reject(function ($value) use ($temp) {
                        return $value['id'] == $temp->id;
                    });
                } else {
                    $temp = null;
                    $temp = $loopAllChargeRemarks
                        ->where('charge_id', $charge->id)
                        ->where('time_type', $timeType)
                        ->where('work_on', $date)
                        ->first();
                    if ($temp) {
                        // 行の配列へ格納
                        $isFound     = true;
                        $lineArray[] = $temp;
                        // 見つかった要素をコレクションから削除する
                        $loopAllChargeRemarks = $loopAllChargeRemarks->reject(function ($value) use ($temp) {
                            return $value['id'] == $temp->id;
                        });
                    } else {
                        $lineArray[] = null;
                    }
                }
            }
            if ($isFound) {
                $resultProjects[] = $lineArray;
            }
        } while ($isFound);
        // dd($resultProjects);

        return;
    }

    public function process()
    {
        $loginId = Auth::id();
        $userName = AuthService::getAuthUser()->name;
        return view('calendar.table', compact('loginId', 'userName'));
    }

}
