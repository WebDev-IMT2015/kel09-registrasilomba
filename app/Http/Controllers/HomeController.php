<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Hash;
use App\User;
use App\Competition;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index(){
        if(Auth::check()){
            $allCompetition = Competition::paginate(10)->setPageName('competition');

            if(Auth::user()->role == "admin"){
                return view('home')->with('user', Auth::user())->with('allCompetition', $allCompetition);
            }else if (Auth::user()->role == "user"){
                return view('home');
            }
        }else{
            return view('main');
        }
    }

    public function verify(){
        if(Auth::user()->confirmed == false){
            return view('verify');
        }else{
            return redirect('/');
        }
    }

    public function verifyCodes(Request $request){
        return $this->verifyCode($request->input('verification_code'));
    }

    public function verifyCode($confirmation_code){
        $user = User::find(Auth::user()->id);

        if ($user->confirmation_code != $confirmation_code)
        {
            return redirect('verify')->with('error', 'true');
        }

        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();

        return redirect('/')->with('verified', 'true');

    }

    public function sendEmailVerify(){
        $user = Auth::user();

        Mail::send('user.email.verify', ['confirmation_code' => $user['confirmation_code']], function($message) use ($user) {
            $message->to($user['email'], $user['name'])->subject('Verify your email address');
        });

        return redirect('verify')->with('emailSent', 'sent');
    }

    public function profile($id){
        $user = User::find($id);

        if(! $user){
            return redirect('/');
        }else {
            return view('user.profile.show')->with('user', $user);
        }
    }

    public function editProfile($id){
        $user = User::find(Auth::user()->id);
        if(Auth::user()->id == $id){
            return view('user.profile.edit')->with('user', $user);
        }else{
            return redirect('profile/'.Auth::user()->id.'/edit');
        }
    }

    public function storeProfile(Request $request, $id){
        $user = User::find(Auth::user()->id);
        if(Auth::user()->id == $id){
            $user->name = $request->input('name');
            if($user->confirmed == false){
                $user->email = $request->input('email');
            }
            $user->alamat = $request->input('alamat');
            if(strlen($request->input('phone_number')) < 10 || strlen($request->input('phone_number')) > 13){
                return redirect('profile/'.$id.'/edit')->with('phone_number', 'wrong format');
            }
            $user->phone_number = $request->input('phone_number');
            $user->save();
            return redirect('profile/'.$id)->with('editProfile', 'success');
        }else{
            return redirect('profile/'.Auth::user()->id.'/edit');
        }
    }

    public function changepass($id){
        $user = User::find(Auth::user()->id);
        if(Auth::user()->id == $id){
            return view('user.profile.password')->with('user', $user);
        }else{
            return redirect('profile/'.Auth::user()->id.'/changepass');
        }
    }

    public function savepass(Request $request, $id){
        $user = User::find(Auth::user()->id);
        if(Auth::user()->id == $id){
            if(Hash::check($request->input('lastPassword'), $user->password)){
                if($request->input('newPassword') == $request->input('retypePassword')){
                    $user->password = bcrypt($request->input('newPassword'));
                    $user->save();
                    return redirect('profile/'.$id)->with('changePass', 'success');
                }else{
                    return redirect('profile/'.$id.'/changepass')->with('retype', 'true');
                }
            }else{
                return redirect('profile/'.$id.'/changepass')->with('error', 'true');
            }
        }else{
            return redirect('/');
        }
    }
}
