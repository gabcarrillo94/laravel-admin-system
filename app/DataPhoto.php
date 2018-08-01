<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class DataPhoto extends Model
{
    protected $fillable = ['data_id',
                           'filename',
                           'location'];
    
    public $timestamps = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'data_photos';
    
     /**
     * Get the user that owns the data.
     */
    public function data()
    {
        return $this->belongsTo('App\Data')->withDefault();
    }
    
    public function getUrlPath()
    {
        return "storage/".substr($this->filename, 7, strlen($this->filename));
    }
}
