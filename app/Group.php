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
}
