<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function guilds()
    {
        return $this->belongsTo('App\Guild', 'guild_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo('App\ApplStatus', 'status_id', 'id');
    }
}
