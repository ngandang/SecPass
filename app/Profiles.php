<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $table = 'profiles';

    public function users()
    {
        return $this->hasOne('App\Profiles','user_id','id');
    }
}
