<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Statistic;
use App\Http\Controllers\AuthController;

class ProfileController extends Controller
{
    public function index()
    {
        // Get current logged in user from session
        $currentUser = AuthController::getCurrentUser();
        
        // If no user is logged in, redirect to login
        if (!$currentUser) {
            return redirect()->route('login')->with('error', 'Please login to access your profile.');
        }

        // Get user statistics
        $userStats = Statistic::where('user_id', $currentUser->user_id)->first();
        
        // Prepare user data for the view
        $userData = [
            'user_id' => $currentUser->user_id,
            'username' => $currentUser->username,
            'name' => $currentUser->name ?: $currentUser->username,
            'email' => $currentUser->email,
            'no_handphone' => $currentUser->no_handphone,
            'saldo' => $userStats ? $userStats->balance : 0,
            'koin' => $userStats ? $userStats->poin : 0,
            'botol' => $userStats ? $userStats->bottle_count : 0,
        ];

        return view('/profile/profile_main', compact('userData'));
    }

     public function detail()
    {
        // Get current logged in user from session
        $currentUser = AuthController::getCurrentUser();
        
        // If no user is logged in, redirect to login
        if (!$currentUser) {
            return redirect()->route('login')->with('error', 'Please login to access your profile.');
        }

        // Prepare user data for the view
        $userData = [
            'user_id' => $currentUser->user_id,
            'username' => $currentUser->username,
            'name' => $currentUser->name ?: $currentUser->username,
            'email' => $currentUser->email,
            'no_handphone' => $currentUser->no_handphone,
        ];

        return view('/profile/profile_detail', compact('userData'));
    }

     public function changepass()
    {
        // Get current logged in user from session
        $currentUser = AuthController::getCurrentUser();
        
        // If no user is logged in, redirect to login
        if (!$currentUser) {
            return redirect()->route('login')->with('error', 'Please login to access your profile.');
        }

        return view('/profile/profile_changepass');
    }

    public function changerekening()
    {
        // Get current logged in user from session
        $currentUser = AuthController::getCurrentUser();
        
        // If no user is logged in, redirect to login
        if (!$currentUser) {
            return redirect()->route('login')->with('error', 'Please login to access your profile.');
        }

        return view('/profile/profile_changerekening');
    }

    public function kebijakanprivasi()
    {
        // Get current logged in user from session
        $currentUser = AuthController::getCurrentUser();
        
        // If no user is logged in, redirect to login
        if (!$currentUser) {
            return redirect()->route('login')->with('error', 'Please login to access your profile.');
        }

        return view('/profile/profile_kebijakan_privasi');
    }

    public function syaratketentuan()
    {
        // Get current logged in user from session
        $currentUser = AuthController::getCurrentUser();
        
        // If no user is logged in, redirect to login
        if (!$currentUser) {
            return redirect()->route('login')->with('error', 'Please login to access your profile.');
        }

        return view('/profile/profile_syarat_ketentuan');
    }
}
