<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'participants_id', 'attachment_no', 'attachment_path', 'attachment_confirmed'
    ];
}
