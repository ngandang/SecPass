<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';

    public function GroupsUsers()
    {
        return $this->hasMany('App\GroupsUsers', 'user_id', 'id');
    }

    public function Profile()
    {
        return $this->hasOne('App\Profile', 'user_id','id');
    }
    public function Role()
    { 
           return $this->belongsTo('App\Role','role_id','id');
    }
    public function Secret()
    { 
           return $this->hasOne('App\Secret','user_id','id');
    }
    public function GPGKeys()
    { 
           return $this->hasOne('App\GPGKeys','user_id','id');
    }
    public function Authentication()
    { 
           return $this->hasOne('App\Authentication','user_id','id');
    }

}
