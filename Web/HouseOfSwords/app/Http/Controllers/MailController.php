<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequests\BugReportRequest;
use App\Http\Requests\MailRequests\MailRequest;
use App\Mail\BugReportEmail;
use Illuminate\Http\Request;
use App\Mail\MailNotify;
use App\Models\Bugreport;
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
            'body' => $request->Text
        ];
        try {
            Bugreport::create(["Text" => $request->Text]);
            Mail::to('info@houseofswords.hu')->send(new BugReportEmail($data));
            return redirect('/bugreport')->with('status', 'Jelentés sikeresen elküldve!');
        } catch (Exception $err) {
            return redirect('/bugreport')->with('status', $err->getMessage());
            // return response()->json([
            //     'success' => false,
            //     'message' => 'Sorry, something went wrong',
            //     'details' => $err->getMessage()
            // ]);
        }
    }
}
