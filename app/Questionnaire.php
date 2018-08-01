<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $fillable = ['user_id',
                        'qst_1',
                        'qst_2',
                        'qst_3_1',
                        'qst_3_2',
                        'qst_3_3',
                        'qst_3_4',
                        'qst_3_5',
                        'qst_3_6',
                        'qst_4',
                        'qst_4_desc',
                        'qst_5',
                        'qst_6',
                        'qst_7',
                        'qst_8',
                        'qst_9',
                        'qst_10',
                        'qst_11',
                        'qst_12',
                        'qst_13',
                        'qst_14',
                        'qst_15',
                        'qst_16',
                        'qst_17'];
    
    public $timestamps = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'questionnaires';
    
     /**
     * Get the user that owns the data.
     */
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }
}
