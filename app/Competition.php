<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Participant;

class Competition extends Model
{
    protected $fillable = [
        'name', 'attachment_total' 
    ];
}
