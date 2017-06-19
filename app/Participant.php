<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Competition;

class Participant extends Model
{
    protected $fillable = [
        'user_id', 'competition_id', 'ktp_picpath', 'ktp_confirmed', 'pdf_picpath', 'pdf_confirmed', 'status' 
    ];
}
