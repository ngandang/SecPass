<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Group extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    protected $table = 'groups';

    use SearchableTrait;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'name' => 10,
        ],
    ];

    public function GroupUser()
    {
        return $this->hasMany('App\GroupUser', 'user_id','id');
    }

    public function User()
    {
        return $this->belongsToMany('App\User','groups_users','group_id','user_id');
    }
    
    public function Secret(){
        return $this->hasMany('App\Secret','groups_id','id');
    }

    public function Account()
    {
        return $this->belongsToMany('App\Account','secrets','group_id','account_id');
    }

    public function Note()
    {
        return $this->belongsToMany('App\Note','secrets','group_id','note_id');
    }
}
