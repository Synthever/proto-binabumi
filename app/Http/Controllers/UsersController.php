<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function addUsers()
    {
        return view('test.add-users', [
            'name' => 'Add Users - SIGMA'
        ]);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'user_id')
            ],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')
            ],
            'name' => 'required|string|max:255',
            'no_handphone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:255',
            'date_created' => 'required|string|max:255',
            'date_updated' => 'required|string|max:255',
        ], [
            'user_id.unique' => 'User ID already exists. Please use a different User ID.',
            'username.unique' => 'Username already exists. Please use a different username.',
            'user_id.required' => 'User ID is required.',
            'username.required' => 'Username is required.',
            'name.required' => 'Full name is required.',
            'no_handphone.required' => 'Phone number is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'date_created.required' => 'Date created is required.',
            'date_updated.required' => 'Date updated is required.',
        ]);

        try {
            $user = Users::create([
                'user_id' => $validated['user_id'],
                'username' => $validated['username'],
                'name' => $validated['name'],
                'no_handphone' => $validated['no_handphone'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'date_created' => $validated['date_created'],
                'date_updated' => $validated['date_updated'],
            ]);

            return redirect()->route('test.add-users')->with('success', 'User successfully added with ID: ' . $user->user_id);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to add user. Please try again.']);
        }
    }
}