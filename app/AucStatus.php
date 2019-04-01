<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AucStatus extends Model
{
    //
    public function auction()
    {
        return $this->hasOne('App\Auction', 'auc_status_id', 'id');
    }
}
