<?php

namespace App\Http\Controllers\Other;

use App\Mail\QouteMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class QouteController extends Controller
{
    public function qoute_mail_send(Request $request){
        Mail::to('michelshabo1@gmail.com')->send(new QouteMail($request));
        return redirect('/');
    }
}
