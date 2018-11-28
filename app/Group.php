<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    public function GroupUser()
    {
        return $this->hasMany('App\GroupUser', 'user_id','id');
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
