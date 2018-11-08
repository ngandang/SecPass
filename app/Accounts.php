<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $table = 'accounts';
    public function Secrets()
    {
        return $this->hasMany('App\Secrets', 'account_id','id');
    }
    public function Users()
    {
        return $this->belongsTo('App\Users','App\Secrets','account_id','user_id');
    }

}
