<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function guild()
    {
        return $this->belongsTo('App\Guild');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    /*
    * Many to Many relationships (event_user)
    */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }


}
