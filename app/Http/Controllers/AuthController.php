<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Database\Seeders\StudentSeeder;
use Illuminate\Http\Request;



class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|not_in:' . StudentSeeder::TEACHER_EMAIL,
            'password' => 'required|confirmed|min:6',
        ], [
            'email.not_in' => __('messages.errors.teacher_email'),
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'student', 
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect()->route('student.dashboard');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }

    return back()->withErrors([
        'email' => __('messages.errors.invalid_credentials'),
    ])->onlyInput('email');
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
