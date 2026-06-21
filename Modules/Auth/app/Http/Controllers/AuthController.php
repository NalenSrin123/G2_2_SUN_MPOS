<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Modules\Auth\Models\Otp;
use Modules\Auth\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

     public function createAdmin()
    {
        $email = 'admin123@gmail.com';

        if (User::where('email', $email)->exists()) {
            return response()->json([
                'message' => 'Admin already exists'
            ], 409);
        }

        $user = User::create([
            'name'     => 'Admin',
            'email'    => $email,
            'password' => Hash::make('12345678'),
            'role'     => 'admin',
        ]);

        return response()->json([
            'message' => 'Admin created successfully',
            'user'    => $user,
        ], 201);
    }

    public function sendOtp(Request $request){
    $request->validate([
        'email' => 'required|email'
    ]);

    $otp = rand(100000, 999999);

    Otp::updateOrCreate(
        ['email' => $request->email],
        [
            'otp' => $otp,
            'expires_at' => now()->addMinutes(5)
        ]
    );

    Mail::to($request->email)->send(
        new SendOtpMail($otp)
    );

    return response()->json([
        'message' => 'OTP sent successfully'
    ]);
}

public function verifyOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'otp' => 'required|digits:6'
    ]);

    $otpRecord = Otp::where('email', $request->email)
        ->where('otp', $request->otp)
        ->first();

    if (!$otpRecord) {
        return response()->json([
            'message' => 'Invalid OTP'
        ], 400);
    }

    if (now()->gt($otpRecord->expires_at)) {
        return response()->json([
            'message' => 'OTP expired'
        ], 400);
    }

    $otpRecord->delete();

    return response()->json([
        'message' => 'OTP verified successfully'
    ]);
}
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('auth::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('auth::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
