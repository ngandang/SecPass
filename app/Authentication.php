<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    protected $table = 'authentication';
    public function Users()
    {
        return $this->belongsTo('App\Users', 'user_id','id');
    }
}
