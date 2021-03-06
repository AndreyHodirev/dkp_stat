<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'leader_id', 'id');
    }
    public function game()
    {
        return $this->belongsTo('App\Game', 'game_id', 'id');
    }
    public function event()
    {
        return $this->hasOne('App\Event');
    }
    public function applications()
    {
        return $this->hasOne('App\Application');
    }
    public function auction()
    {
        return $this->hasOne('App\Auction');
    }
    public function userM()
    {
        return $this->hasOne('App\User', 'guild_id', 'id');
    }
    /*
    * Many to Many relationships (guild_user)
    */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
