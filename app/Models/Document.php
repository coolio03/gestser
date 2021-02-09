<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User','responsable_id');
    }
   
    public function demande()
    {
        return $this->belongTo('App\Models\Demande','demande_id');
    }
}
