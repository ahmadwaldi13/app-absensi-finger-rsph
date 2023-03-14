<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        if (Auth::user()) {
            return redirect('/');
        }

        return view('auth/login');
    }

    public function login(Request $request)
    {
        if (Auth::user()) {
            return redirect('/');
        }

        $request->validate([
            'id_user' => 'required',
            'password' => 'required'
        ]);

        try {
            \DB::connection()->getPDO();
        } catch (\Exception $e) {
            Session::put('login_error_message', 'Silahkan hubungi IT support applikasi tidak connect dengan database');
            return view('auth/login');
        }
        // id_user dan password di encrypt pake aes dgn key 'nur'
        // nanti dicari di table
        try {
            $user = $this->authService->getUserByCredential($request->id_user, $request->password);
            if($user){
                Auth::loginUsingId($user->id, true);
                Session::put('get_id_user',$user->id);
                $request->session()->regenerate();
            }
        } catch(\Illuminate\Database\QueryException $e){
            if($e->errorInfo[1] == '1054'){
                Session::put('login_error_message', 'Silahkan hubungi IT support untuk tetap dapat mengakses aplikasi');
            }else{
                Session::put('login_error_message', 'Id user atau password salah');
            }

            return view('auth/login');

        } catch (\Throwable $e) {
            Session::put('login_error_message', 'Id user atau password salah');
            return view('auth/login');
        }

        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        $request->session()->flush();

        return redirect('login');
    }
}
