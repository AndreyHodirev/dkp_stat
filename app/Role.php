<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /*
    * Many to Many relationships (role_user)
    */

    public function users()
    {
        return $this->hasOne('App\User', 'role_id', 'id');
    }
}
