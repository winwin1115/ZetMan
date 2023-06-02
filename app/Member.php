<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use SoftDeletes, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        // 'charge_id',
        'name',
        'sort',
        'edit_type',
    ];

    // public function charge()
    // {
    //     return $this->belongsTo('App\charge');
    // }
}
