<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompetitionController extends Controller
{
	
    public function event(){
    	return view('event.add');
    }
}
