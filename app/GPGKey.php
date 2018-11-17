<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GPGKey extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    
    protected $table = 'gpgkeys';
    public function User()
    {
        return $this->belongsTo('App\User', 'user_id','id');
    }
}
