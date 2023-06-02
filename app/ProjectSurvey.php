<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 現地調査情報のModel
 */
class ProjectSurvey extends Model
{
    //use SoftDeletes;

    /**
     * リレーション：案件
     *
     * @return void
     */
    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }

    /**
     * リレーション：現地調査画像
     *
     * @return void
     */
    public function surveyImages()
    {
        return $this->hasMany('App\SurveyImage');
    }
}
