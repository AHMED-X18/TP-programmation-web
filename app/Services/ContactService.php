<?php

namespace App\Services;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    public function sendContactEmail(array $data)
    {
        // Remplacez par votre adresse mail réelle qui recevra les messages
        $adminEmail = "rtchapetngamini@gmail.com";

        Mail::to($adminEmail)->send(new ContactMail($data));
    }
}