<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Authentication extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $table = 'authentication';
    public function Users()
    {
        return $this->belongsTo('App\Users', 'user_id','id');
    }
}
