<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function upload(Request $request)
    {
    	$attachment = $request->file('attachment');

    	if(!empty($attachment)):
    		foreach ($attachment as $file) {
    			Storage::put()
    		}
            return view('competition.join');
    }
}
