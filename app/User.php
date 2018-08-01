<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'phone',
        'whatsapp',
        'instagram',
        'body_type',
        'type',
        'register',
        'sex',
        'product_code',
        'program',
        'birthdate',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * Get the data record associated with the user.
     */
    public function data()
    {
        return $this->hasMany('App\Data');
    }
    
    /**
     * Get the data record associated with the user.
     */
    public function questionnaire()
    {
        return $this->hasOne('App\Questionnaire')->withDefault([
            'qst_1' => '',
            'qst_2' => '',
            'qst_3_1' => 0,
            'qst_3_2' => 0,
            'qst_3_3' => 0,
            'qst_3_4' => 0,
            'qst_3_5' => 0,
            'qst_3_6' => 0,
            'qst_4' => '',
            'qst_4_desc' => '',
            'qst_5' => '',
            'qst_6' => '',
            'qst_7' => '',
            'qst_8' => '',
            'qst_9' => '',
            'qst_10' => '',
            'qst_11' => '',
            'qst_12' => '',
            'qst_13' => '',
            'qst_14' => 0,
            'qst_15' => '',
            'qst_16' => '',
            'qst_17' => ''
        ]);
    }
}
