<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Anggota;

class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | FORM LOGIN
    |--------------------------------------------------------------------------
    */

    public function loginForm()
    {
        if (auth()->check()) {
            return $this->redirectByRole(auth()->user()->role);
        }

        return view('auth.login');
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');

        if (!Auth::attempt($credentials)) {
            return back()->with('error','Email atau password salah');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        return $this->redirectByRole($user->role);

    }


    /*
    |--------------------------------------------------------------------------
    | REDIRECT BERDASARKAN ROLE
    |--------------------------------------------------------------------------
    */

    private function redirectByRole($role)
    {

        switch ($role) {

            case 'anggota':
                return redirect()->route('home');

            case 'petugas':
                return redirect()->route('admin.dashboard');

            case 'kepala':
                return redirect()->route('admin.dashboard');

            default:

                Auth::logout();

                return redirect()->route('login')
                    ->with('error','Role tidak dikenali');

        }

    }


    /*
    |--------------------------------------------------------------------------
    | FORM REGISTER
    |--------------------------------------------------------------------------
    */

    public function register()
    {
        return view('auth.register');
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES REGISTER ANGGOTA
    |--------------------------------------------------------------------------
    */

    public function registerStore(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        // buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota'
        ]);

        // buat data anggota otomatis
        Anggota::create([
            'user_id' => $user->id,
            'kode_anggota' => 'AG'.rand(1000,9999),
            'nama' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'aktif'
        ]);

        return redirect()->route('login')
            ->with('success','Registrasi berhasil, silahkan login');

    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout()
    {

        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success','Berhasil logout');

    }

}