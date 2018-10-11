<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    protected $table = 'groups';
    public function GroupsUsers()
    {
        return $this->hasMany('App\GroupsUsers', 'user_id','id');
    }
}
