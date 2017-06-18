<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadFiles()
    {
    	return view('UploadFiles');
    }
    public function uploadSubmit(UploadRequest $request)
    {

    }
}
