<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Authenticate
{
    public function authGoogle($data, Request $request)
    {   
        try {
            $user = new User;
            $userFound = $user->where('email', $data->email)->first();
    
            $request['email'] = $userFound->email ?? $data->email;
            $request['name'] = $userFound->name ?? $data->givenName.' '.$data->familyName;
            $request['password'] = $userFound->password ?? Hash::make('admin_123');
            
            DB::beginTransaction();
            if (!$userFound) {
                $userFound = User::create($request->toArray());
            }
            DB::commit();
    
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
    
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('home');
            } else {
                throw new \Exception("The provided credentials do not match our records.");
            }
            
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
