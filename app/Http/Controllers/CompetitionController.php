<?php

namespace App\Http\Controllers;

use App\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
	
    public function competition(){
    	return view('competition.add');
    }

    public function saveCompetition(Request $request){
    	if($request->input('name') != "" && $request->input('attachment_total') >= 3){
	    	$competition = new Competition;
	    	$competition->name = $request->input('name');
	    	$competition->attachment_total = $request->input('attachment_total');
	    	$competition->save();
	    	return redirect('/');
    	}else{
    		if($request->input('name') == ""){
    			if($request->input('attachment_total') < 3){
    				return redirect('competition/add')->with('name', 'cannot be empty')->with('attachment_total', 'must be 3 or higher');
    			}else{
    				return redirect('competition/add')->with('name', 'cannot be empty');
    			}
    		}else if($request->input('attachment_total') < 3){
    			return redirect('competition/add')->with('attachment_total', 'must be 3 or higher');
    		}
    	}
    }

	public function manage($id){
		if(Competition::find($id)){
			return view('competition.manage')->with('competition', Competition::find($id));
		}else{
			return redirect('/');
		}
    }

    public function list($id){
    	if(Competition::find($id)){
			return view('competition.list')->with('competition', Competition::find($id));
		}else{
			return redirect('/');
		}
    }
}
