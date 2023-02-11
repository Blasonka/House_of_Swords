<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use Illuminate\Http\Request;
use App\Mail\MailNotify;
use Exception;
use Illuminate\Support\Facades\Mail;



class MailController extends Controller
{
    public function index()
    {
        return view('mail.index');
    }
    public function mail(MailRequest $request)
    {
        // return dd($request);

        $data = [
            'header' => $request->Title,
            'body' => $request->Text
        ];
        try
        {
            Mail::to($request->Email)->send(new MailNotify($data));
            return response()->json(['Great, check your mailbox']);
        }
        catch (Exception $th)
        {
            return response()->json(['Sorry, something went wrong', $th]);
        }
    }
}
