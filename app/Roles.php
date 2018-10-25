<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
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

    public function Users()
    {
        return $this->hasMany('App\Users', 'role_id','id');
    }
}
