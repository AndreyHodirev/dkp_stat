<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplStatus extends Model
{
    //
    public function appl()
    {
        return $this->hasOne('App\Application', 'status_id', 'id');
    }
}
