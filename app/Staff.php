<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'staffs';
    protected $fillable = [
        'user_id',
        'charge_id',
        'name',
        'sort',
    ];
}
