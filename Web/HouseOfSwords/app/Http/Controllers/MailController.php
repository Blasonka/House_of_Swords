<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequests\BugReportRequest;
use App\Http\Requests\MailRequests\MailRequest;
use Illuminate\Http\Request;
use App\Mail\MailNotify;
use App\Models\User;
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
        $data = [
            'header' => $request->Title,
            'body' => $request->Text
        ];
        try {
            Mail::to($request->Email)->send(new MailNotify($data));
            return response()->json(['Great, check your mailbox']);
        } catch (Exception $th) {
            return response()->json(['Sorry, something went wrong', $th]);
        }
    }

    public function emailVerification($token)
    {
        try {
            $user = User::where('EmailVerificationToken', $token);
            $user->update(['IsEmailVerified' => 1, 'EmailVerificationToken' => null]);
            return redirect()->route('index');
        } catch (Exception $th) {
            return response()->json(['Sorry, something went wrong', $th]);
        }
    }

    function bugReportMail(BugReportRequest $request)
    {
        $data = [
            'header' => 'Bug Report',
            'body' => $request->Text
        ];
        try {
            Mail::to('blasek.balazs@gmail.com')->send(new MailNotify($data));
            return response()->json(['Great, check your mailbox']);
        } catch (Exception $err) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, something went wrong',
                'details' => $err->getMessage()
            ]);
        }
    }
}
