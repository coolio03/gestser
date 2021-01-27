<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborateur extends Model
{
    protected $guarded = [];

    public function admin(){
        return $this->belongsTo('App\Models\Admin','cadre_id');
    }
    
    public function demande()
    {
        return $this->hasMany('App\Models\Demande');
    }
}
