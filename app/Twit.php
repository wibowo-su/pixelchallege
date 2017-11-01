<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Twit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'message',
    ];

    public function user($value='')
    {
      return $this->belongsTo('app\User');
    }
}
