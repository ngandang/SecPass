<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    protected $table = 'roles';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    public function User()
    {
        return $this->hasMany('App\User', 'role_id','id');
    }
}
