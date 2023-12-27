<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Mail\ResetePassword;
use App\Models\User;
use App\Services\Auth\Authenticate;
use App\Services\Auth\GoogleClient;
use App\Services\UsuarioServices;
use Illuminate\{
    Http\Request,
    Support\Facades\Auth
};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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

    public function register(Request $request) {
        $this->googleClient->initRegister();
        $authUrl = $this->googleClient->generateLink();

        if($this->googleClient->authenticated()){
            $request['by_register'] = true;
            return $this->auth->authGoogle($this->googleClient->getData(), $request);
        }

        return view('auth.register', compact('authUrl'));
    }

    public function newUser(CreateUserRequest $request, User $user) {
        try {
            if($request->password != $request->confirm_password) throw new \Exception("A Senha e a confirmação estão divergentes!");
            User::create($request->toArray());
            return redirect()->route("login");
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(["errors" => $th->getMessage()])->withInput();
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

    public function resete_default_password(User $user) {
        return view('auth.resete_default_password', compact('user'));
    }

    public function new_password(Request $request, User $user) {
        try {
            if($request->password != $request->confirm_password) throw new \Exception('Senhas Incompatíveis! A senha e a confirmação de senha devem ser iguais');

            $user->update($request->only('password'));

            return redirect()->route('home');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function resete_password(Request $request) {
        try {
            $method = $request->method();
            if($method != "GET") {
                $userFound = User::where('email', $request->email)->get()->first();
                if($userFound == null) throw new \Exception("O email informado não está cadastrado no sistema!");
                Mail::to($request->email, $request->email)->send(new ResetePassword(['from' => $request->email, 'user' => $userFound]));
                return redirect()->route('login');
            }
            return view('auth.resete_password');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->withErrors(['errors' => $th->getMessage()])->withInput();
        }
    }

    public function password_edit(User $user) {
        return view('auth.forgot_password', compact('user'));
    }
}