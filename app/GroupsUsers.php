<?php

namespace App;
 
use Illuminate\Database\Eloquent\Model;

class GroupsUsers extends Model
{
    protected $table = 'groups_users';

    public function Users()
    {
        return $this->belongsToMany('App\Users','user_id','id');
    }
    public function Groups()
    {
        return $this->belongsToMany('App\Groups','group_id','id');
    }
}
