<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $table = 'accounts';
    public function Secret()
    {
        return $this->hasMany('App\Secret', 'account_id','id');
    }

}
