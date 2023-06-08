<?php

namespace App\Http\Controllers\Backend\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailtosubscriberController extends Controller
{
    public function index()
    {
        return view('Backend.Subscriber.emailtosubscriber');
    }
    public function getdata(Request $request)
    {
        // $users = subscriber::get(['email']);
        $users = subscriber::select('email')->get()->toArray();
        $emails = array_column($users, 'email');
        $data['long_text'] = $request->long_text;
        // echo '<pre>';
        // print_r($request->long_text);
        // die;
        if (send_mail('emails.subscription', $data, $emails, "test user", $request->title)) {
            $data['status'] = 1;
            $data['massage'] = "Test Mail Send Successfully";
        } else {
            $data['status'] = 0;
            $data['massage'] = "SendSubscriptionEmail Error";
        }
        return json_encode($data);
    }
}
