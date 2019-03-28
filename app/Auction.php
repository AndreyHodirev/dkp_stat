<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    public function crUser()
    {
        return $this->belongsTo('App\User', 'id','user_create');
    }
    public function customerUser()
    {
        return $this->belongsTo('App\User', 'id', 'user_customer');
    }
    public function guild()
    {
        return $this->belongsTo('App\Guild');
    }
}
