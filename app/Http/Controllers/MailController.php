<?php

namespace App\Http\Controllers;

use App\Mail\MailSender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public static function sendRegistrationMail($data)
    {
        try {
            Mail::to($data['to'])->send(new MailSender($data));
        } catch (\Throwable $th) {
            error_log($th->getMessage());
        }
    }
}
