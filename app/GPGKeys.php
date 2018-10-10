<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GPGKeys extends Model
{
    protected $table = 'gpgkeys';
    public function Users()
    {
        return $this->belongsTo('App\Users', 'user_id','id');
    }
}
