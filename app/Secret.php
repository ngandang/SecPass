<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Secret extends Model
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
    
    public function User()
    {
        return $this->belongsTo('App\User', 'user_id','id');
    }

    public function Account()
    {
        return $this->belongsTo('App\Account', 'account_id','id');
    }

    public function Note()
    {
        return $this->belongsTo('App\Note', 'note_id','id');
    }
    public function Group()
    {
        return $this->belongsTo('App\Group','group_id','id');
    }
}
