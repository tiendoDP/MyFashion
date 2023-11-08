<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function register_user() {
        $data['header_title'] = 'Register';
        return view('client/auth/register', $data);
    }

    public function insert(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'check' => 'required',
        ], [
            'required' => 'The :attribute field is required',
            'email' => ':attribute lỗi',
            'unique' => ':attribute đã tồn tại',
            'min' => ':attribute phải lớn hơn 6 ký tự',
        ]);

        $token_verify_email = Hash::make(Str::random(10));

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->token_verify_email = $token_verify_email;
        $user->roles = 0;
        $user->save();

        MailController::sendMail($token_verify_email, $user->email);
        
        return redirect()->route('login')->with('success', "User Successfully Created");
        //return redirect()->route('VerifyEmail.Message');
    }
}
