<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Share extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $guarded = [];

    protected $table = 'share';
    
    public function User()
    {
        return $this->belongsTo('App\User', 'user_id','id');
    }

    public function Account()
    {
        return $this->belongsTo('App\Account', 'asset_id','id');
    }

    public function Note()
    {
        return $this->belongsTo('App\Note', 'asset_id','id');
    }
}
