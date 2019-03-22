<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function guild()
    {
        return $this->belongsTo('App\Guild');
    }
    
    /*
    * Many to Many relationships (event_user)
    */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
