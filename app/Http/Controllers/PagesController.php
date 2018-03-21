<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;
use Agent;
use CountryState;
class PagesController extends Controller
{
    public function showHome(){

//        IDK
        $countries = CountryState::getCountries();
        $states = CountryState::getStates('US');


        return view('pages.index');
    }





    public function showContact(){
        return view('pages.contact');
    }




    public function contactform(Request $request){
        $this->validate($request, [
            'name' => 'required',

            'email' => 'required|email',

        ]);


        $data = array(
            'name' => $request->name,

            'email' => $request->email,

            'messbody' => $request->messbody


        );

        Mail::send('emails.contact', $data, function($message) use ($data) {
            $message->from($data['email']);
            $message->to(env('MAIL_USERNAME', 'nickskye7@gmail.com'));
            $message->subject('IntelliSkye Contact');


        });
        session()->flash('success', 'Successfully sent message!');

        return redirect()->back()->with('success', true)->with('message','Successfully sent message!');
    }

}
