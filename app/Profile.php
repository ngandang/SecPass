<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $guarded = [];

    protected $table = 'profiles';

    public function User()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
