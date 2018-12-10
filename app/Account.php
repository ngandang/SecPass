<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Account extends Model
{
    use Uuids;
    use SearchableTrait;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'name' => 10,
            'username' => 10,
            'uri' => 2,
        ],
    ];


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

    public function Share()
    {
        return $this->hasOne('App\Share', 'asset_id','id');
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
