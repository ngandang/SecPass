<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Users extends Authenticatable
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


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
