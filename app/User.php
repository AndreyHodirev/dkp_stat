<?php

namespace App;


use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'confirmation_token','is_confirmed','is_admine_CH777','guild_id','role_id'
    ];
    /**
     * or 
     * 
     * protected $guarded = [];
     */

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var boolean 
     */

    public function confirmed()
    {
        return !! $this->is_confirmed;
    }

    public function getEmailConfirmationToken()
    {
        

        $this->update([
            'confirmation_token' => $token = Str::random(),
        ]);
        
        return $token;
    }

    public function confirm()
    {
        $this->update([
            'is_confirmed' => true,
            'confirmation_token' => null,
        ]);
        return $this;
    }
    
    public function is_manager()
    {
        return $this->guilds()->where('leader_id', Auth::id())->pluck('id');
    }

    public function game()
    {
        return $this->hasOne('App\Game');
    }

    public function guild()
    {
        return $this->hasOne('App\Guild');
    }
    public function applications()
    {
        return $this->hasOne('App\Application');
    }
    public function guildM()
    {
        return $this->belongsTo('App\Guild', 'guild_id', 'id');
    }
    /*
    * Many to Many relationships (role_user)
    */
    public function roles()
    {
        return $this->belongsTo('App\Role');
    }
    /*
    * Many to Many relationships (event_user)
    */
    public function events()
    {
        return $this->belongsToMany('App\Event');
    }
}

