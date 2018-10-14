<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use Uuids;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $table = 'notes';
    public function Secrets()
    {
        return $this->hasMany('App\Secrets', 'note_id','id');
    }
}
