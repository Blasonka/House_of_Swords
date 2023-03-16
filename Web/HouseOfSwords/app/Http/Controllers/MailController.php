<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequests\BugReportRequest;
use App\Http\Requests\MailRequests\MailRequest;
use App\Http\Requests\MailRequests\PwResetRequest;
use App\Mail\BugReportEmail;
use Illuminate\Http\Request;
use App\Mail\MailNotify;
use App\Mail\PwResetEmail;
use App\Mail\VerificationEmail;
use App\Models\Bugreport;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use stdClass;

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
        $data = new stdClass();
        $data->body = $request->Text;

        if (Auth::user()) {
            $user = Auth::user();
            $data->email = $user->EmailAddress;
        } else {
            $data->email = 'anonymus';
        };

        try {
            Bugreport::create(["Text" => $request->Text, 'EmailAddress' => $data->email, 'Date' => date('Y-m-d')]);
            Mail::to('info@houseofswords.hu')->send(new BugReportEmail($data));
            return redirect('/bugreport')->with('status', 'Jelentés sikeresen elküldve!');
        } catch (Exception $err) {
            // return redirect('/bugreport')->with('errors', 'Jelentés küldése sikertelen! Kérjük próbálja újra később, vagy vegye fel a kapcsolatot velünk közvetlenül emailben.');
            return redirect('/bugreport')->with('errors', $err->getMessage());


            // return response()->json([
            //     'success' => false,
            //     'message' => 'Sorry, something went wrong',
            //     'details' => $err->getMessage()
            // ]);
        }
    }

    function verifyResend()
    {
        try {
            $user = Auth::user();
            $user->update(['EmailVerificationToken' => Str::random(32)]);
            // $user = User::find(Auth::user());
            // $user->update(['EmailVerificationToken' => Str::random(32)]);

            Mail::to($user->EmailAddress)->send(new VerificationEmail($user));
            return redirect()->back()->with('status', 'Az email sikeresen elküldve! Kérlek nézd meg a bejövő leveleidet és a spam mappádat is.');
        } catch (Exception $err) {
            return redirect()->back()->with('errors', 'A hitelesítő email újraküldése sikertelen! Kérjük próbálja újra később.');
            return redirect()->back()->with('errors', $err->getMessage());
        }
    }

    function resetpw(PwResetRequest $request)
    {
        try {
            $user = User::where('EmailAddress', $request->EmailAddress)->first();
            $user->update(['EmailVerificationToken' => Str::random(32)]);
            Mail::to($request->EmailAddress)->send(new PwResetEmail($user));
            return redirect()->back()->with('status', 'A jelszó visszaállító email sikeresen elküldve! Kérlek nézd meg a bejövő leveleidet és a spam mappádat is.');
        } catch (Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }
}
