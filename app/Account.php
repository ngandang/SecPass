<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $table = 'accounts';

    public function Secret()
    {
        return $this->hasOne('App\Secret', 'account_id','id');
    }

    public function User()
    {
        return $this->belongsToMany('App\User','secrets','account_id','user_id');
    }
    public function Group()
    {
        return $this->belongsToMany('App\Group','secrets','account_id','group_id');
    }

}
