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

    public function join(Request $request){

        return view('competition.join');
    }

    public function upload(Request $request){
        $this->validate($request,[
        'ktp' => 'required|image',
        'pdf' => 'required|file|mimes:application/pdf, application/x-pdf,application/acrobat, applications/vnd.pdf, text/pdf, text/x-pdf|max:10000',
        'hasil_karya.*' => 'required|image']);

        $attachment = new Attachment;
        $attachment->participants_id = $request->input('participants_id');
        $attachment->attachment_no = $request->input('attachment_no');
        $attachment->attachment_path = $request->input('attachment_path');
        $attachment->attachment_no = $request->input('attachment_no');

        return redirect('/');
    }
}
