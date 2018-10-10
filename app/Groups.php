<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $table = 'groups';
    public function GroupsUsers()
    {
        return $this->hasMany('App\GroupsUsers', 'user_id','id');
    }
}
