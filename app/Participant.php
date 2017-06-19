<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'id', 'user_id', 'competition_id', 'ktp_picpath', 'ktp_confirmed', 'pdf_picpath', 'pdf_confirmed', 'status' 
    ];

    public function user(){
<<<<<<< HEAD
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function competition(){
    	return $this->belongsTo('App\Competition', 'competition_id', 'id');
=======
    	return $this->belongTo('App\User', 'user_id', 'id');
    }

    public function competition(){
    	return $this->belongTo('App\Competition', 'competition_id', 'id');
>>>>>>> refs/remotes/origin/master
    }

    public function attachment(){
    	return $this->hasMany('App\Attachment', 'participants_id', 'id');
    }
}
