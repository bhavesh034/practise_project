<?php


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;



function update_option($name, $value)
{
    /**
     * Create the option if not exists
     * @since  2.3.3
     */
    if (!option_exists($name)) {
        return add_option($name, $value);
    }

    DB::table('settings')
        ->where('name', $name)
        ->update(['value' => $value]);

    return true;
}

function get_option($name)
{
    return DB::table('settings')->where(['name' => $name])->first();
}
function option_exists($name)
{
    $option_Data = DB::table('settings')->where(['name' => $name])->first();
    if (isset($option_Data->name)) {
        return true;
    }
    return false;
}
function add_option($name, $value = '')
{
    if (!option_exists($name)) {

        $newData = [
            'name'  => $name,
            'value' => $value,
        ];

        $lastInsertId = DB::table('settings')->insertGetId($newData);


        if ($lastInsertId) {
            return true;
        }

        return false;
    }

    return false;
}
function send_mail($templete, $data, $to, $to_name, $subject)
{

    Config::set('mail.mailers.smtp.host', isset(get_option('smtp_host')->value) ? get_option('smtp_host')->value : '');
    Config::set('mail.mailers.smtp.username', isset(get_option('username')->value) ? get_option('username')->value : '');
    Config::set('mail.mailers.smtp.password', isset(get_option('password')->value) ? get_option('password')->value : '');
    Config::set('mail.mailers.smtp.port', isset(get_option('port')->value) ? get_option('port')->value : '');
    Config::set('mail.mailers.smtp.encryption', isset(get_option('encryption')->value) ? get_option('encryption')->value : '');
    Config::set('mail.from.address', isset(get_option('emailAddress')->value) ? get_option('emailAddress')->value : '');
    Config::set('mail.from.name', isset(get_option('senderName')->value) ? get_option('senderName')->value : '');

    // $from = isset(get_option('senderName')->value) ? get_option('senderName')->value : '';
    try {
        Mail::send($templete, $data, function ($message) use ($to, $to_name, $subject) {
            $message->to($to, $to_name)
                ->subject($subject);
        });
        return true;
    } catch (\Exception $e) {
        return false;
        // Get error here
    }
}
