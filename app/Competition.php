<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'name', 'attachment_total' 
    ];

    public function participant(){
        return $this->hasMany('App\Participant', 'competition_id', 'id');
    }
}
