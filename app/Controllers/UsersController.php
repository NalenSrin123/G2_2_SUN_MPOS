<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersDevController extends Controller
{
    public function loginAdmin()
    {
        // Check if admin already exists
        if (User::where('email', 'admin123@gmail.com')->exists()) {
            return response()->json([
                'message' => 'Admin already exists'
            ], 409);
        }

        $user = User::create([
            'name'     => 'Admin',
            'email'    => 'admin123@gmail.com',
            'password' => Hash::make('12345678'),
            'role'     => 'admin',
        ]);

        return response()->json([
            'message' => 'Admin created successfully',
            'user'    => $user,
        ], 201);
    }
}