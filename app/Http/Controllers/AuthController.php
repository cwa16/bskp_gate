<?php

namespace App\Http\Controllers;

use App\Mail\ActiveLoginNotification;
use App\Mail\OTPMail;

use App\Models\LogActivity;
use App\Models\User;

use App\Services\OtpService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;

use Hash;
use Auth;
use Mail;

class AuthController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function index()
    {
        $title = 'Register';
        return view('auth.registrasi', [
            'title' => $title
        ]);
    }

    public function login_index()
    {
        $title = 'BSKP GATE - Login';
        return view('auth.login', [
            'title' => $title
        ]);
    }

    public function otp_index()
    {
        $title = 'BSKP GATE - OTP Verification';
        return view('auth.otp-verification', [
            'title' => $title
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            $activeLogin = LogActivity::where('nik', $user->nik)
                ->where('otp_valid_until', '>', now())
                ->whereNotNull('login_at')
                ->whereNotNull('otp_verified_at')
                ->latest()
                ->first();

            if ($activeLogin) {
                $ipAddress = $request->ip();
                Mail::to($user->email)->send(new ActiveLoginNotification($user->nik, $user->email, now(), $ipAddress, $user->name));
                toastr()->closeOnHover(true)->closeButton(10)->success('Login Berhasil!!!');
                $token = JWTAuth::fromUser(Auth::user());
                $user = Auth::user();
                $otp = $activeLogin->otp_code;
                $request->session()->put('jwt_token', $token);
                $request->session()->put('otp', $otp);
                return redirect()->route('dashboard', ['token' => $token, 'user' => $user, 'otp' => $otp]);
            }

            $pendingOtp = LogActivity::where('nik', $user->nik)
                ->where('otp_valid_until', '>', now())
                ->whereNull('otp_verified_at')
                ->latest()
                ->first();

            if ($pendingOtp) {
                Mail::to($user->email)->send(new OTPMail($pendingOtp->otp_code));

                toastr()->closeOnHover(true)->closeButton(10)->info('Kode OTP telah dikirim ulang ke email anda.');
                return redirect()->route('otp-verify');
            }

            $otp = $this->otpService->generateOTP();
            $otpEndcrypted = $this->otpService->hashOTP($otp);
            $getUserData = User::where('nik', $user->nik)->first();

            $loginActivity = LogActivity::create([
                'user_id' => $user->id,
                'nik' => $user->nik,
                'ip_address' => $request->ip(),
                'otp_code' => $otp,
                'otp_encrypt' => $otpEndcrypted,
                'otp_valid_start' => now(),
                'otp_valid_until' => now()->addDays(1),
            ]);

            $data = [
                'otp_code' => $otp,
                'nik' => $getUserData->nik,
                'name' => $getUserData->name,
                'email' => $getUserData->email,
                'otp_valid_until' => now()->addDays(1)->format('d-m-Y H:i')
            ];

            Mail::to($user->email)->send(new OTPMail($data));

            toastr()->closeOnHover(true)->closeDuration(10)->success('OTP telah dikirim email Anda.');
            return redirect()->route('otp.index');
        }

        toastr()->closeOnHover(true)->closeDuration(10)->error('Silahkan isi Email & Password dengan benar.');
        return back()->withErrors(['email' => 'Invalid Credentials.']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        $loginActivity = LogActivity::where('user_id', Auth::id())
            ->where('otp_valid_until', '>', now())
            ->whereNull('otp_verified_at')
            ->whereNull('login_at')
            ->latest()
            ->first();

        if ($loginActivity && now()->lt($loginActivity->otp_valid_until)) {
            if (Hash::check($request->otp, $loginActivity->otp_encrypt)) {
                $loginActivity->update([
                    'login_at' => now(),
                    'otp_verified_at' => now()
                ]);

                $user = Auth::user();
                $token = JWTAuth::fromUser(Auth::user());
                $request->session()->put('jwt_token', $token);

                return redirect()->route('dashboard', ['token' => $token, 'user' => $user]);

            } else {
                return back()->withErrors(['otp' => 'OTP is inccorect.']);
            }
        }

        return back()->withErrors(['otp' => 'OTP has expired.']);
    }

    public function logout(Request $request)
    {
        $userId = $request->user_id;
        $nik = $request->nik;

        $dateTimeNow = Carbon::now();

        $addLogoutTime = LogActivity::where('nik', $nik)->first();
        $addLogoutTime->update([
            'logout_at' => $dateTimeNow
        ]);

        if ($addLogoutTime) {
            toastr()->closeOnHover(true)->closeDuration(10)->success('Anda telah berhasil logout, Silahkan Login Kembali!.');
            return redirect()->route('login.index');
        }

    }

}
