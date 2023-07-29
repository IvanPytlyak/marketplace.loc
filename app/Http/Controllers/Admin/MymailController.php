<?php

namespace App\Http\Controllers\Admin;

use App\Mail\MailMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MymailController extends Controller
{
    public function index()
    {
        return view('mails.mailform');
    }
    public function sendEmail(Request $request)
    {
        $subject = $request->input('subject');
        $message = $request->input('message');
        // dd(gettype($message));
        $emails = $request->input('emails');
        $emailsArray = explode(',', $emails);
        // dd($subject, $message, $emails, $emailsArray);
        foreach ($emailsArray as $email) {
            Mail::to(trim($email))->send(new MailMessage($subject, $message));
        }
        return redirect()->route('home');
    }
}
