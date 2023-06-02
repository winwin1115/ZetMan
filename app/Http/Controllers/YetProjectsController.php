<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Services\AuthService;

/**
 * (ユーザー向け)未解体案件の画面のController
 */
class YetProjectsController extends Controller
{
    public function index(Request $request)
    {
        $params     = [];
        $params['project_type'] = [config('const.project.type.undisassembled')];
        $user_id  = AuthService::getAuthUser()->id;
        $projects = Project::search($params, $user_id)->get();
        return view('calendar.undemolition', compact('projects','user_id'));
    }

    public function register($id)
    {
        // 案件が自分自身のユーザーIDに紐づいていない場合、元ページへリダイレクト
        $project = Project::find($id);
        if ($project->user_id !== AuthService::getAuthUser()->id) {
            return redirect()->back();
        }
        $user_id  = AuthService::getAuthUser()->id;
        return view('calendar.undemolitionRegister', compact('id','user_id'));
    }
}
