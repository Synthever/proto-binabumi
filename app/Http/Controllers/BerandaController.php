<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Statistic;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\File;

class BerandaController extends Controller
{
    public function index()
    {
        // Get current logged in user from session
        $currentUser = AuthController::getCurrentUser();
        
        // If no user is logged in, redirect to login
        if (!$currentUser) {
            return redirect()->route('login')->with('error', 'Please login to access the dashboard.');
        }

        // Get user statistics
        $userStats = Statistic::where('user_id', $currentUser->user_id)->first();
        
        // Prepare user data for the view
        $userData = [
            'user_id' => $currentUser->user_id,
            'username' => $currentUser->username,
            'name' => $currentUser->name ?: $currentUser->username, // Use name or fallback to username
            'email' => $currentUser->email,
            'no_handphone' => $currentUser->no_handphone,
            'profile_picture' => $this->getProfilePictureUrl($currentUser->user_id),
            'location' => 'Lokasi Kamu', // Default location for now
            'saldo' => $userStats ? $userStats->balance : 0,
            'koin' => $userStats ? $userStats->poin : 0,
            'botol' => $userStats ? $userStats->bottle_count : 0,
            'pengumpulan' => 0, // This might need to be calculated from another table
            'berhasil' => 0,    // This might need to be calculated from another table
            'pending' => 0      // This might need to be calculated from another table
        ];

        return view('beranda.beranda', compact('userData'));
    }

    /**
     * Get profile picture URL for user
     */
    public function getProfilePictureUrl($userId)
    {
        try {
            $user = Users::findByUserId($userId);
            if ($user && !empty($user->profile_picture)) {
                $picturePath = public_path('assets/profile_pict/' . $user->profile_picture);
                if (File::exists($picturePath)) {
                    return asset('assets/profile_pict/' . $user->profile_picture);
                }
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
