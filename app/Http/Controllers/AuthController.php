<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Connection;
use App\Models\Statistic;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.loginPages', [
            'name' => 'Login - SIGMA'
        ]);
    }

    public function daftar()
    {
        return view('auth.daftarPages', [
            'name' => 'Daftar - SIGMA'
        ]);
    }

    public function googleLogin()
    {
        return view('auth.loginPages1', [
            'name' => 'Login - SIGMA'
        ]);
    }

    public function googleStep1()   
    {
        return view('auth.loginPages2', [
            'name' => 'Login - SIGMA'
        ]);
    }

    public function loginManual()   
    {
        return view('auth.loginManual', [
            'name' => 'Login - SIGMA'
        ]);
    }

    public function loginManualStep1()   
    {
        return view('auth.loginManual1', [
            'name' => 'Login - SIGMA'
        ]);
    }

    public function forgotPassword()
    {
        return view('auth.forgotPassword', [
            'name' => 'Forgot Password - SIGMA'
        ]);
    }

    public function forgotPasswordVerifikasi()
    {
        return view('auth.forgotPasswordVerifikasi', [
            'name' => 'Forgot Password Verification - SIGMA'
        ]);
    }

    public function forgotPasswordNew()
    {
        return view('auth.forgotPasswordNew', [
            'name' => 'Forgot Password New - SIGMA'
        ]);
    }

    /**
     * Process user registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                'min:3',
                Rule::unique('users', 'username')
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
            ],
            'password' => 'required|string|min:8|confirmed',
        ], [
            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at least 3 characters.',
            'username.unique' => 'Username already exists. Please choose a different username.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'Email already exists. Please use a different email.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        try {
            // Generate unique user_id (minimum 5 digits)
            do {
                $user_id = str_pad(mt_rand(10000, 99999999), 5, '0', STR_PAD_LEFT);
            } while (Users::where('user_id', $user_id)->exists());

            $currentDateTime = date('Y-m-d H:i:s');

            // Create user
            $user = Users::create([
                'user_id' => $user_id,
                'username' => $validated['username'],
                'name' => $validated['username'], // Name sama dengan username
                'no_handphone' => '-', // Default value
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'is_login' => false,
                'date_created' => $currentDateTime,
                'date_updated' => $currentDateTime,
            ]);

            // Auto create connection record
            Connection::create([
                'user_id' => $user_id,
                'is_connect' => false,
                'machine_id' => '-',
                'date_created' => $currentDateTime,
                'date_updated' => $currentDateTime,
            ]);

            // Auto create statistic record
            Statistic::create([
                'user_id' => $user_id,
                'balance' => '0',
                'poin' => 0,
                'bottle_count' => 0,
                'date_created' => $currentDateTime,
                'date_updated' => $currentDateTime,
            ]);

            return redirect()->route('login')->with('success', 'Registration successful! Please login with your credentials.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }

    /**
     * Process user login
     */
    public function loginProcess(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|string', // Can be email or username
            'password' => 'required|string',
        ], [
            'login.required' => 'Email or username is required.',
            'password.required' => 'Password is required.',
        ]);

        try {
            // Check if login field is email or username
            $loginField = filter_var($validated['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            
            // Find user
            $user = Users::where($loginField, $validated['login'])->first();

            if ($user && Hash::check($validated['password'], $user->password)) {
                // Update login status
                $user->update([
                    'is_login' => true,
                    'date_updated' => date('Y-m-d H:i:s')
                ]);

                // Set session or authentication
                session(['user_id' => $user->user_id, 'username' => $user->username]);

                return redirect()->route('beranda')->with('success', 'Login successful! Welcome back, ' . $user->username);
            } else {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['error' => 'Invalid credentials. Please check your email/username and password.']);
            }

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Login failed. Please try again.']);
        }
    }

    /**
     * Process user logout
     */
    public function logout(Request $request)
    {
        try {
            // Get current user from session
            $userId = session('user_id');
            
            if ($userId) {
                // Update login status to false
                Users::where('user_id', $userId)->update([
                    'is_login' => false,
                    'date_updated' => date('Y-m-d H:i:s')
                ]);
            }

            // Clear session
            session()->flush();

            return redirect()->route('login')->with('success', 'You have been logged out successfully.');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Logout failed. Please try again.');
        }
    }

    /**
     * Get current logged in user
     */
    public static function getCurrentUser()
    {
        $userId = session('user_id');
        
        if (!$userId) {
            return null;
        }

        return Users::where('user_id', $userId)->where('is_login', true)->first();
    }
}