<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secret extends Model
{
    protected $table = 'secret';
    public function Users()
    {
        return $this->belongsTo('App\Users', 'user_id','id');
    }
    public function Resouces()
    {
        return $this->belongsTo('App\Accounts', 'account_id','id');
    }
}
