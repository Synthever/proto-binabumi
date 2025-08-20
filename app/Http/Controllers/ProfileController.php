<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Statistic;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Get current authenticated user or return error response
     * 
     * @return object|null
     */
    private function getCurrentAuthenticatedUser()
    {
        return AuthController::getCurrentUser();
    }

    /**
     * Check if user is authenticated and redirect if not
     * 
     * @return \Illuminate\Http\RedirectResponse|null
     */
    private function checkAuthentication()
    {
        $currentUser = $this->getCurrentAuthenticatedUser();
        
        if (!$currentUser) {
            return redirect()->route('login')->with('error', 'Please login to access your profile.');
        }
        
        return null;
    }

    public function index()
    {
        // Check authentication
        $redirectResponse = $this->checkAuthentication();
        if ($redirectResponse) return $redirectResponse;
        
        // Get current logged in user from session
        $currentUser = $this->getCurrentAuthenticatedUser();

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
            'profile_picture' => $this->getProfilePictureUrl($currentUser->user_id),
        ];

        return view('/profile/profile_main', compact('userData'));
    }

     public function detail()
    {
        // Check authentication
        $redirectResponse = $this->checkAuthentication();
        if ($redirectResponse) return $redirectResponse;
        
        // Get current logged in user from session
        $currentUser = $this->getCurrentAuthenticatedUser();

        // Prepare user data for the view
        $userData = [
            'user_id' => $currentUser->user_id,
            'username' => $currentUser->username,
            'name' => $currentUser->name ?: $currentUser->username,
            'email' => $currentUser->email,
            'no_handphone' => $currentUser->no_handphone,
            'profile_picture' => $this->getProfilePictureUrl($currentUser->user_id),
        ];

        return view('/profile/profile_detail', compact('userData'));
    }

     public function changepass()
    {
        // Check authentication
        $redirectResponse = $this->checkAuthentication();
        if ($redirectResponse) return $redirectResponse;

        return view('/profile/profile_changepass');
    }

    public function changerekening()
    {
        // Check authentication
        $redirectResponse = $this->checkAuthentication();
        if ($redirectResponse) return $redirectResponse;

        return view('/profile/profile_changerekening');
    }

    public function kebijakanprivasi()
    {
        // Check authentication
        $redirectResponse = $this->checkAuthentication();
        if ($redirectResponse) return $redirectResponse;

        return view('/profile/profile_kebijakan_privasi');
    }

    public function syaratketentuan()
    {
        // Check authentication
        $redirectResponse = $this->checkAuthentication();
        if ($redirectResponse) return $redirectResponse;

        return view('/profile/profile_syarat_ketentuan');
    }

    /**
     * Upload profile picture
     */
    public function uploadProfilePicture(Request $request)
    {
        try {
            // Get current logged in user from session
            $currentUser = $this->getCurrentAuthenticatedUser();
            
            if (!$currentUser) {
                return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
            }

            // Validate the uploaded file
            $request->validate([
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                
                // Generate a random filename to avoid conflicts
                $randomName = Str::random(32) . '.' . $file->getClientOriginalExtension();
                
                // Define the upload path
                $uploadPath = public_path('assets/profile_pict');
                
                // Create directory if it doesn't exist
                if (!File::exists($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true);
                }
                
                // Delete old profile picture if exists
                $this->deleteOldProfilePicture($currentUser->user_id);
                
                // Move the uploaded file to the destination
                $file->move($uploadPath, $randomName);
                
                // Update user's profile picture in database
                $user = Users::findByUserId($currentUser->user_id);
                if ($user) {
                    $user->profile_picture = $randomName;
                    $user->date_updated = now();
                    $user->save();
                    
                    // Update session data
                    session(['user.profile_picture' => $randomName]);
                }
                
                return response()->json([
                    'success' => true, 
                    'message' => 'Profile picture uploaded successfully',
                    'filename' => $randomName,
                    'url' => asset('assets/profile_pict/' . $randomName)
                ]);
            }
            
            return response()->json(['success' => false, 'message' => 'No file uploaded'], 400);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete old profile picture
     */
    private function deleteOldProfilePicture($userId)
    {
        try {
            $user = Users::findByUserId($userId);
            if ($user && !empty($user->profile_picture)) {
                $oldFilePath = public_path('assets/profile_pict/' . $user->profile_picture);
                
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }
        } catch (\Exception $e) {
            // Log error but don't stop the upload process
            Log::error('Failed to delete old profile picture: ' . $e->getMessage());
        }
    }

    /**
     * Get profile picture URL
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

    /**
     * Update profile data
     */
    public function updateProfile(Request $request)
    {
        try {
            // Get current logged in user from session
            $currentUser = $this->getCurrentAuthenticatedUser();
            
            if (!$currentUser) {
                return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
            }

            // Validate the request
            $request->validate([
                'username' => 'nullable|string|max:255',
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'no_handphone' => 'nullable|string|max:20',
            ]);

            $user = Users::findByUserId($currentUser->user_id);
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found: ' . $currentUser->user_id], 404);
            }

            // Update user data
            if ($request->has('username')) $user->username = $request->username;
            if ($request->has('name')) $user->name = $request->name;
            if ($request->has('email')) $user->email = $request->email;
            if ($request->has('no_handphone')) $user->no_handphone = $request->no_handphone;
            
            $user->date_updated = now();
            $user->save();

            // Update session data
            session(['user' => $user]);

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'user' => $user
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Update failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
