<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $table = 'notes';

    public function Secret()
    {
        return $this->hasOne('App\Secret', 'note_id','id');
    }
    
    public function User()
    {
        return $this->belongsToMany('App\User','secrets','note_id','user_id');
    }
}
