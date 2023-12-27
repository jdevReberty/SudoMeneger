<?php

namespace App\Services\Auth;

use App\Mail\DefaultPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;

class Authenticate
{
    public function authGoogle($data, Request $request)
    {   
        try {
            $userFound = User::where('email', $data->email)->get()->first();

            if($request->by_register == true && $userFound != null) {
                throw new \Exception('O usuario já está cadastrado no sistema');
            }
            
            if (!$userFound) {
                $request['name'] = $data->givenName.' '.$data->familyName;
                $request['email'] = $data->email;
                $request['password'] = \Illuminate\Support\Str::random(8);
                $request['avatar'] = $data->picture;

                $userFound = User::create($request->toArray());

                $credentials = $request->validate([
                    'email' => ['required', 'email'],
                    'password' => ['required'],
                ]);

                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();

                    Mail::to($userFound->email, $userFound->name)
                        ->send(New DefaultPassword(
                                [
                                    'password' => $request->password, 
                                    'from' => $userFound->email,
                                    'user_id' => $userFound->id,
                                ]
                            )
                        );

                    return redirect()->route('home');
                } else {
                    throw new \Exception("The provided credentials do not match our records.");
                }
            }

            Auth::login($userFound);
            $request->session()->regenerate();
            return redirect()->route('home');

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        // unset($_SESSION['user'], $_SESSION['logged']);
        // dd(session()->get('user'));
    }
}
