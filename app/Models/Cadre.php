<?php


namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cadre extends Authenticatable
{
    use Notifiable;

    protected $guard = 'cadre';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name', 'email', 'password',
    ];*/
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function collaborateur()
    {
        return $this->hasMany('App\Models\Collaborateur');
    }
    public function demande()
    {
        return $this->hasMany('App\Models\Demande');
    }
}
