<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Secret extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $guarded = [];

    protected $table = 'secrets';
    
    public function User()
    {
        return $this->belongsTo('App\User', 'owner_id','id');
    }

    public function Account()
    {
        return $this->belongsTo('App\Account', 'asset_id','id');
    }

    public function Note()
    {
        return $this->belongsTo('App\Note', 'asset_id','id');
    }
    
    public function Group()
    {
        return $this->belongsTo('App\Group','owner_id','id');
    }
}
