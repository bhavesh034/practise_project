<?php

namespace App\Http\Controllers\Backend\Setting;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SmtpSettiingController extends Controller
{
   public function view()
   {
      return view('Backend.Smtp.smtp');
   }
   public function insert(Request $rerquest)
   {
      $data['status'] = 0;
      $data['massage'] = "SMTP record not save";
      $post = $rerquest->post();

      if ($post) {

         foreach ($post as $name => $value) {
            update_option($name, $value);
         }
         $data['status'] = 1;
         $data['massage'] = "SMTP insert successful";
      }
      return json_encode($data);
   }
   public function mail(Request $request)
   {
      $data = $request->all();
    

      if(send_mail('emails.testmail',$data,$data['testMail'],"test user",'Test Mail From palladiumjub_cms')){
         $data['status'] = 1;
         $data['massage'] = "Test Mail Send Successfully";
       }else{
         $data['status'] = 0;
         $data['massage'] = "SMTP Error";
       }
      return json_encode($data);

    
   }
}
