<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Secrets extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $guarded = [];

    protected $table = 'secrets';
    
    public function Users()
    {
        return $this->belongsTo('App\Users', 'user_id','id');
    }

    public function Accounts()
    {
        return $this->belongsTo('App\Accounts', 'account_id','id');
    }

    public function Notes()
    {
        return $this->belongsTo('App\Notes', 'note_id','id');
    }
}
