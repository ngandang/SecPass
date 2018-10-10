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
    public function Users()
    {
        return $this->hasMany('App\Users', 'role_id','id');
    }
}
