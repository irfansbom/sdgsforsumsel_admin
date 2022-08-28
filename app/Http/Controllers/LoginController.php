<?php

namespace App\Http\Controllers;

use App\Mail\kode_verif;
use App\Models\Kabs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    //


    public function index()
    {
        return view('login.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        } else {
            return back()->with('error', "gagal");
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function register()
    {
        $kabkot = Kabs::all();
        return view('login/register', compact('kabkot'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'captcha' => 'required|captcha'
        ]);
        $data = User::where('email', $request->email)->first();
        if ($data) {
            return back()->withInput()->with('error', 'email telah terdaftar');
        }
        $affected_rows = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'instansi' => $request->instansi,
            'kd_wilayah' => $request->kabkot,
            'created_by' => null,
        ]);
        if ($affected_rows) {
            // Session::put('email', $request->email);
            $request->session()->put('email', $request->email);
            $this->send_kode($request);
            return redirect('verifikasi')->with(['email' => $request->email]);
        } else {
            return  back()->withInput()->with('error', 'Gagal Terdaftar');
        }
    }

    public function verifikasi(Request $request)
    {
        $email = $request->session()->get('email');
        $user = User::where('email', $email)->first();
        return view('login.verifikasi', compact('user', 'email'));
    }

    public function send_kode(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->kode_verif = rand(10000, 99999);
        $user->save();
        Mail::to($request->email)->send(new kode_verif($user));
        print_r('success');
    }

    public function verifikasi_kode(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user->kode_verif == $request->kode_verifikasi) {
            $user->email_verified_at = date("Y-m-d H:i:s");
            $user->save();
            return  redirect('login')->with('message', 'silahkan login');
        }
        return back()->withInput()->with('error', 'Verifikasi Salah');
    }
}
