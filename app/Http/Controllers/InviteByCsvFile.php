<?php

namespace Meet\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use Maatwebsite\Excel\Facades\Excel;
use Meet\Attenda;
use Meet\Invitee;
use Meet\Mail\InviteMember;
use Session;
class InviteByCsvFile extends Controller
{
    public function store(Request  $request){

        $data = Excel::load($request->csv->path(), function($reader) {})->get();
      
            if(!empty($request)){

            
            if(!empty($data) && $data->count()){

                foreach ($data->toArray() as $key => $v) {
                    if(!empty($v)){
                        $attend = new Attenda();
                        $attend->email = $v['email'];
                        $attend->phone = $v['phone'];
                        $attend->fullname = $v['name'];
                        $attend->user_id = Auth::id ();
                        $attend->address = $v['address'];
                        $attend->save ();
                                        
                        Invitee::create(['meeting_id' =>$request->get ('meeting_id'), 'user_id' => Auth::user ()->id, 'invitee_email' => $v['email']]);

                        Mail::to ($v['email'])->send (new InviteMember('http://localhost:8000/accept/invitation/' . $request->get ('meeting_id') . '/' . $request->get ('meeting_owner')));
                    }else{
                        Session::flash('alert-danger','please this file is empty, no data found');
                    
                    }
                }
                Session::flash('alert-success','successfully sent and saved.');
              
        }else{
            Session::flash('alert-danger','this file was not imported and sent,check if it contains data.');
           
        }
    }else{
        Session::flash('alert-danger','This is not csv type');
    }
    return redirect ()->back ();
    }
}
