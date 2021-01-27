<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{


    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User','responsable_id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin','cadre_id');
    }
    public function collaborateur()
    {
        return $this->belongsTo('App\Models\Collaborateur','collaborateur_id');
    }
    public function document()
    {
        return $this->hasMany('App\Models\Document');
    }

}
