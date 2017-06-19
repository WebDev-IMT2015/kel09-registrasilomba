<?php

namespace App\Http\Controllers;

use App\User;
use App\Competition;
use App\Participant;
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
            $participants = Participant::where('competition_id', $id)->paginate(5);
			return view('competition.manage')->with('competition', Competition::find($id))->with('participants', $participants)->with('users', User::all());
		}else{
			return redirect('/');
		}
    }

    public function userList($id){
    	if(Competition::find($id)){
			$participants = Participant::where('competition_id', $id)->paginate(5);
            return view('competition.list')->with('competition', Competition::find($id))->with('participants', $participants)->with('users', User::all());
		}else{
			return redirect('/');
		}
    }

    public function viewAttachment($id){
        if(Participant::find($id)){
            return view('competition.participant.view')->with('participant',Participant::find($id));
        }else{
            return redirect('/');
        }
    }

    public function join(Request $request, $id){
        if(Competition::find($id)){
            return view('competition.join')->with('competition', Competition::find($id));
        }else{
            return redirect('/');
        }
    }

    public function upload(Request $request, $id){
        $this->validate($request,[
        'ktp' => 'required|image',
        'pdf' => 'required|file|mimes:pdf|max:10000',
        'hasil_karya.*' => 'required|image']);

        // $participant = new Participant;
        // $participant->user_id = Auth::user()->id;
        // $participant->competition_id = $id;
        // $participant->
        // $attachment = new Attachment;
        // $attachment->participants_id = $request->input('participants_id');
        // $attachment->attachment_no = $request->input('attachment_no');
        // $attachment->attachment_path = $request->input('attachment_path');
        // $attachment->attachment_no = $request->input('attachment_no');

        return redirect('/');
        // return $request;
    }
}
