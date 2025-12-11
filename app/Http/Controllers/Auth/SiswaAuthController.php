<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SiswaAuthController extends Controller
{
    public function showLogin()
    {
        return view('siswa.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'nis';

        if (Auth::attempt([$loginField => $credentials['email'], 'password' => $credentials['password']], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('jenjang.sd'));
        }

        return back()->withErrors(['email' => 'Email/NIS atau kata sandi salah.'])->withInput();
    }

    public function showSignup()
    {
        return view('siswa.signup');
    }

    public function signup(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:120',
            'email'=>'required|email|unique:users,email',
            'nis'=>'nullable|unique:users,nis',
            'password'=>'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'nis'=>$data['nis'] ?? null,
            'password'=>Hash::make($data['password']),
            'role'=>'siswa',
        ]);

        Auth::login($user);
        return redirect()->intended(route('jenjang.sd'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}