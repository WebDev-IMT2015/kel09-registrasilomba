<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilesPhoto extends Model
{
    protected $fillable = ['product_id', 'filename'];
 
    public function files()
    {
        return $this->belongsTo('App\Files');
    }
}
