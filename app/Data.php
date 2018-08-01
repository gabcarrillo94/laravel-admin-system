<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $fillable = ['user_id',
                           'chest',
                           'abdominal',
                           'thigh',
                           'bicep',
                           'tricep',
                           'subscapular',
                           'suprailiac',
                           'lower_back',
                           'calf',
                           'midaxillary',
                           'neck',
                           'bodyweight',
                           'waist',
                           'hips',
                           'abdomen',
                           'height_integer',
                           'height_decimal',
                           'metric_system',
                           'jp7',
                           'pcm',
                           'ntm',
                           'calculation_date'];
    
    public $timestamps = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'data';
    
     /**
     * Get the user that owns the data.
     */
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }
    
    /**
     * Get the data record associated with the user.
     */
    public function photos()
    {
        return $this->hasMany('App\DataPhoto');
    }
}
