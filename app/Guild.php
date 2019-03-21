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
}
