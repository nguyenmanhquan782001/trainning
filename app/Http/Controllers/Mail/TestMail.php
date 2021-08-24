<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestMail extends Controller
{
    public  function  sendEmail () {
        $details = [
            'title' => "Hello anh em",
            'body' => "Anh em đang làm gì đó"
        ];
        Mail::to('quannmph11896@fpt.edu.vn')->send(new SendMail($details));
        return "OK send mail";
    }
}
