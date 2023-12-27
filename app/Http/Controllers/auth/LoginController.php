<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\Authenticate;
use App\Services\Auth\GoogleClient;
use App\Services\UsuarioServices;
use Illuminate\{
    Http\Request,
    Support\Facades\Auth
};

class LoginController extends Controller
{
    public function __construct(
        protected UsuarioServices $usuarioService,
        protected GoogleClient $googleClient,
        protected Authenticate $auth
    ){}

    public function index(Request $request) {
        
        /* -------------- geracao do código de autenticação via google -------------- */
        $this->googleClient->init();
        $authUrl = $this->googleClient->generateLink();

        if($this->googleClient->authenticated()){
            $request['by_register'] = false;
            return $this->auth->authGoogle($this->googleClient->getData(), $request);
        }

        return view('auth.login', compact('authUrl'));
    }
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('home');
            }

            throw new \Exception("The provided credentials do not match our records.");
     
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors([
                'error' => $th->getMessage(),
            ])->withInput();
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

    public function home() {
        $contemEmpresa = $this->usuarioService->contemEmpresa();
        return view('welcome', compact('contemEmpresa'));
    }

    
}