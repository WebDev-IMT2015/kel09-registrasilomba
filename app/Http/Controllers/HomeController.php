<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index(){
        return Auth::check() ? view('home') : view('main');
    }

    public function verify(){
        if(Auth::user()->confirmed == 0){
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

        $user->confirmed = 1;
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

    public function storeProfile($id){
        $user = User::find(Auth::user()->id);
        if(! $user){
            return redirect('/');
        }else {
            if(Auth::user()->id == $id){
                return view('user.profile.edit')->with('user', $user);
            }else{
                return view('user.profile.edit')->with('user', $user)->with('');
            }
        }
    }
}
