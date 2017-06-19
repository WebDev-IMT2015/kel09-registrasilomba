<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'participants_id', 'attachment_no', 'attachment_path', 'attachment_confirmed'
    ];

    public function participant(){
    	return $this->belongTo('App\Attachment', 'participants_id', 'id');
    }
}
