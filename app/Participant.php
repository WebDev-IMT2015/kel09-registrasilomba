<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'id', 'user_id', 'competition_id', 'ktp_picpath', 'ktp_confirmed', 'pdf_picpath', 'pdf_confirmed', 'status' 
    ];
}
