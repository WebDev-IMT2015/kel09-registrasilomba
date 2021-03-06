<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\User;
use App\Competition;
use App\Participant;
use App\Attachment;
use Response;
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

    public function validateAttachment($id){
        if(Participant::find($id)){
            $participant = Participant::find($id);
            if($participant->status != 2){
                $attachment = Attachment::where('participants_id', $id);
                return view('competition.participant.validate')->with('participant', $participant)->with('attachment', $attachment);
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }

    public function join(Request $request, $id){
        $participate = Participant::where('user_id', Auth::user()->id)->where('competition_id', $id)->count() > 0;
        if(Competition::find($id) && $participate == false){
            return view('competition.join')->with('competition', Competition::find($id));
        }else{
            return redirect('/');
        }
    }

    public function upload(Request $request, $id){
        $this->validate($request,[
        'ktp' => 'required|image|max:10000',
        'surat' => 'required|file|mimes:pdf|max:10000',
        'hasil_karya.*' => 'required|image|max:10000']);

        $participant = new Participant;
        $participant->user_id = Auth::user()->id;
        $participant->competition_id = $id;
        $ktp = $request->file('ktp')->store('ktp');
        $pdf = $request->file('surat')->store('pdf');
        $participant->ktp_picpath = str_replace('\\','/',$ktp);
        $participant->pdf_picpath = str_replace('\\','/',$pdf);
        $participant->save();

        $hasil_karya = $request->file('hasil_karya');
        for ($i = 1; $i <= count($hasil_karya); $i++) {
            $attachment = new Attachment;
            $attachment->participants_id = $participant->id;
            $attachment->attachment_no = $i;
            $attachment->attachment_path = str_replace('\\','/',$hasil_karya[$i]->store('hasil_karya'));
            $attachment->save();
        }
        return redirect('/');
    }

    public function revision($id){
        if(Participant::find($id)->user_id == Auth::user()->id){
            $participant = Participant::find($id);
            $attachment = Attachment::where('participants_id', $id);
            return view('competition.participant.revision')->with('participant', $participant)->with('attachment', $attachment);
        }else{
            return redirect('/');
        }
    }

    public function view($id){
        if(Participant::find($id)->user_id == Auth::user()->id){
            $participant = Participant::find($id);
            $attachment = Attachment::where('participants_id', $id);
            return view('competition.participant.view')->with('participant', $participant)->with('attachment', $attachment);
        }else{
            return redirect('/');
        }
    }


    public function viewAttachment($id){
        if(Participant::find($id)){
            $participant = Participant::find($id);
            return view('competition.participant.view')->with('participant', $participant)->with('attachment', Attachment::where('participants_id', $participant->id));
        }else{
            return redirect('/');
        }
    }

    public function viewKtp($id){
        $filename = Participant::find($id)->ktp_picpath;
        $path = storage_path('app/'.Participant::find($id)->ktp_picpath);

        return Response::download($path);
    }

    public function viewPdf($id){
        $filename = Participant::find($id)->pdf_picpath;
        $path = storage_path('app/'.Participant::find($id)->pdf_picpath);

        return Response::download($path);
    }

    public function viewKarya($id, $no){
        $karya = Attachment::all();
        $karya = $karya->where('participants_id',$id)->where('attachment_no', $no)->first();
        $filename = $karya->attachment_path;
        $path = storage_path('app/'.$karya->attachment_path);

        return Response::download($path);
    }

    public function validating($id, Request $request){
        if(Participant::find($id)){
            $participant = Participant::find($id);
            if($participant->ktp_confirmed == false){
                if($request->has('ktp')){
                    $participant->ktp_confirmed = true;
                }
            }
            if($participant->pdf_confirmed == false){
                if($request->has('pdf')){
                    $participant->pdf_confirmed = true;
                }
            }

            $participant->save();
            $attachment = Attachment::where('participants_id', $id);
            foreach ($attachment->get() as $attach) {
                if($request->has('hasil_karya'.$attach->attachment_no)){
                    $attach->attachment_confirmed = true;
                    $attach->save();
                }
            }

            $accepted = true;

            if($participant->ktp_confirmed == false){
                $accepted = false;
            }
            if($participant->pdf_confirmed == false){
                $accepted = false;
            }
            foreach ($attachment as $attach) {
                if($attach->attachment_confirmed == false){
                    $acepted = false;
                }
            }

            if($accepted == false){
                $participant->status = 1;
                $user = User::find($participant->user_id);

                Mail::send('user.email.revision', ['user' => User::find($participant->user_id), 'competition' => Competition::find($participant->competition_id), 'participant' => $participant], function($message) use ($user) {
                    $message->to($user->email, $user->name)->subject('Revise your Competition Requirement');
                });
            }else{
                $participant->status = 2;
            }
            $participant->save();
            return redirect('/');
        }else {
            return redirect('/');
        }
    }

    public function accept($id){
        if(Participant::find($id)){
            $participant = Participant::find($id);
            $participant->ktp_confirmed = true;
            $participant->pdf_confirmed = true;
            $participant->status = 2;
            $participant->save();

            $attachment = Attachment::where('participants_id', $id);
            foreach ($attachment->get() as $attach) {
                $attach->attachment_confirmed = true;
                $attach->save();
            }
        }
        return redirect('/');
    }

    public function revise(Request $request, $id){
        if(Participant::find($id)){
            $participant = Participant::find($id);
            $attachment = Attachment::where('participant_id', $id);
            $ktp = true;
            $pdf = true;
            $karya = true;
            if($participant->ktp_confirmed == false){
                $ktp = false;
            }
            if($participant->pdf_confirmed == false){
                $pdf = false;
            }
            foreach ($attachment as $attach) {
                if($attach->attachment_confirmed == false){
                    $karya = false;
                }
            }

            if($ktp == false){
                if($pdf == false){
                    if($karya == false){
                        $this->validate($request,[
                        'ktp' => 'required|image|max:10000',
                        'surat' => 'required|file|mimes:pdf|max:10000',
                        'hasil_karya.*' => 'required|image|max:10000']);
                    }else{
                        $this->validate($request,[
                        'ktp' => 'required|image|max:10000',
                        'surat' => 'required|file|mimes:pdf|max:10000']);
                    }
                }else{
                    if($karya == false){
                        $this->validate($request,[
                        'ktp' => 'required|image|max:10000',
                        'hasil_karya.*' => 'required|image|max:10000']);
                    }else{
                        $this->validate($request,[
                        'ktp' => 'required|image|max:10000']);
                    }
                }
            }else{
                if($pdf == false){
                    if($karya == false){
                        $this->validate($request,[
                        'surat' => 'required|file|mimes:pdf|max:10000',
                        'hasil_karya.*' => 'required|image|max:10000']);
                    }else{
                        $this->validate($request,[
                        'surat' => 'required|file|mimes:pdf|max:10000']);
                    }
                }else{
                    if($karya == false){
                        $this->validate($request,[
                        'hasil_karya.*' => 'required|image|max:10000']);
                    }
                }
            }

            if($participant->ktp_confirmed == false){
                $ktp = $request->file('ktp')->store('ktp');
                $participant->ktp_picpath = str_replace('\\','/',$ktp);
            }
            if($participant->pdf_confirmed == false){
                $pdf = $request->file('surat')->store('pdf');
                $participant->pdf_picpath = str_replace('\\','/',$pdf);
            }
            $participant->status = 0;
            $participant->save();

            $hasil_karya = $request->file('hasil_karya');
            $i = 1;
            foreach ($attachment as $attach) {
                if($attach->attachment_confirmed == false){
                   $attach->attachment_path = str_replace('\\','/',$hasil_karya[$i]->store('hasil_karya')); 
                   $attach->save();
                }
            }
        }
        return redirect('/');
    }
}
