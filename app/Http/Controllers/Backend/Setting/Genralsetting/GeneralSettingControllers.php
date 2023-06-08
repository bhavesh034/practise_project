<?php

namespace App\Http\Controllers\Backend\setting\Genralsetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GeneralSettingControllers extends Controller
{
    public function index()
    {

        // Get Value...................................................................................................
        $img_name = get_option('logo_img');
        $favicon_name = get_option('favicon_img');
        // $email = get_option('email');
        // $number = get_option('number');
        // $favcolor = get_option('favcolor');
        // $sendemail = get_option('send_email');
        // $receiveemail = get_option('receive_email');



        // Store In Array..................................................................................................

        $data['logo'] = isset($img_name->value) ? ($img_name->value) : '';
        $data['favicon'] = isset($favicon_name->value) ? ($favicon_name->value) : '';
        // $data['email'] = isset($email->value) ? ($email->value) : '';
        // $data['number'] = isset($number->value) ? ($number->value) : '';
        // $data['favcolor'] = isset($favcolor->value) ? ($favcolor->value) : '';
        // $data['send_email'] = isset($sendemail->value) ? ($sendemail->value) : '';
        // $data['receive_email'] = isset($receiveemail->value) ? ($receiveemail->value) : '';

        // Return View................................................................................................
        return view('Backend.Generalsetting.generalsetting', $data);
    }
    // Logo.....................................................................................................
    public function logoinsert(Request $request)
    {

        $data['status'] = 0;
        $data['massage'] = "Logo not successful";
        if ($request->img_name) {
            $image_path = public_path(LOGO_IMAGE_PATH) . '/' . $request->img_name;
            @unlink($image_path);
        }

        if ($request->file('logo_img')) {
            $file = $request->file('logo_img');

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path(LOGO_IMAGE_PATH), $filename);

            $imageAdd['logo_img'] = $filename;


            if ($filename) {
                $img_name['logo_img'] = $filename;
                foreach ($img_name as $name => $value) {
                    update_option($name, $value);
                }
                $data['status'] = 1;
                $data['massage'] = "Logo update successful";
            }
        }
        return json_encode($data);
       
    }
    // Favicon.....................................................................................................
    public function faviconinsert(Request $request)
    {
      
        
        $data['status'] = 0;
        $data['massage'] = "Favicon Logo not successful";
        if ($request->favicon_img) {
            $image_path = public_path(FAVICON_IMAGE_PATH) . '/' . $request->favicon_img;
            @unlink($image_path);
        }

        if ($request->file('favicon_img')) {
            $file = $request->file('favicon_img');

            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path(FAVICON_IMAGE_PATH), $filename);



            if ($filename) {
                $img_name['favicon_img'] = $filename;
                foreach ($img_name as $name => $value) {
                    update_option($name, $value);
                }
                $data['status'] = 1;
                $data['massage'] = "Favicon Logo update successful";
            }
        }
        return json_encode($data);
    }
    // Top Bar.....................................................................................................
    public function topbarinsert(Request $request)
    {
        $data['status'] = 0;
        $data['massage'] = "SMTP record not save";
        $post = $request->post();
        if ($post) {
            foreach ($post as $name => $value) {
                update_option($name, $value);
            }
            $data['status'] = 1;
            $data['massage'] = "Top insert successful";
        }
        return json_encode($data);
    }
    // Email .....................................................................................................
    public function emailsendinsert(Request $request)
    {
        $data['status'] = 0;
        $data['massage'] = "Email record not save";
        $post = $request->post();
        if ($post) {
            foreach ($post as $name => $value) {
                update_option($name, $value);
            }
            $data['status'] = 1;
            $data['massage'] = "Email insert successful";
        }
        return json_encode($data);
    }
    // Color .....................................................................................................
    public function colorinsert(Request $request)
    {
        $data['status'] = 0;
        $data['massage'] = "Color record not save";
        $post = $request->post();
        if ($post) {
            foreach ($post as $name => $value) {
                update_option($name, $value);
            }
            $data['status'] = 1;
            $data['massage'] = "Color insert successful";
        }
        return json_encode($data);
    }
    public function social_media_insert(Request $request)
    {
        $data['status'] = 0;
        $data['massage'] = "Email record not save";
        $post = $request->post();

        if ($post) {
            foreach ($post as $name => $value) {
                update_option($name, $value);
            }
            $data['status'] = 1;
            $data['massage'] = "Record insert successful";
        }
        return json_encode($data);
    }
}
