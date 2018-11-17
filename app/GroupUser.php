<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    protected $table = 'groups_users';

    public function User()
    {
        return $this->belongsToMany('App\User','user_id','id');
    }
    
    public function Group()
    {
        return $this->belongsToMany('App\Group','group_id','id');
    }
}
