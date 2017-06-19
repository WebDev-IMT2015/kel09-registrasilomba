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
        $this->validate($request,[
            'name' => 'required', 
            'attachment_total' => 'required|numeric|min:3|max:5']);
    
            $competition = new Competition;
            $competition->name = $request->input('name');
            $competition->attachment_total = $request->input('attachment_total');
            $competition->save();
            return redirect('/');
    }

	public function manage($id){
		if(Competition::find($id)){
			return view('competition.manage')->with('competition', Competition::find($id));
		}else{
			return redirect('/');
		}
    }

    public function userList($id){
    	if(Competition::find($id)){
			return view('competition.list')->with('competition', Competition::find($id));
		}else{
			return redirect('/');
		}
    }

    public function join($id){
        
    }
}
