<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AucStatus extends Model
{
    //
    public function auctions()
    {
        return $this->hasMany('App\Auction');
    }
}
