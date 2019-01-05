<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetTracking extends Model
{
    use Uuids;

     /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $table = 'asset_tracking';

    public function User()
    { 
        return $this->belongsToMany('App\User','user_id','id');
    }

    public function Account()
    { 
        return $this->belongsToMany('App\Account','asset_id','id');
    }

    public function Note()
    { 
        return $this->belongsToMany('App\Note','asset_id','id');
    }
}
