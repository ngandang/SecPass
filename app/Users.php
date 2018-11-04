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
    // protected $fillable = [
    //     'name', 'email', 'password', 'verification_code',
    // ];
    protected $guarded = [];

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

    public function Profiles()
    {
        return $this->hasOne('App\Profiles', 'user_id','id');
    }

    public function Roles()
    { 
           return $this->belongsTo('App\Roles','role_id','id');
    }

    public function Secrets()
    { 
           return $this->hasOne('App\Secrets','user_id','id');
    }
    
    public function GPGKeys()
    { 
           return $this->hasOne('App\GPGKeys','user_id','id');
    }
}
