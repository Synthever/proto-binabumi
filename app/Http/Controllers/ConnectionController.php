<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Connection;
use App\Models\Users;
use Illuminate\Validation\Rule;

class ConnectionController extends Controller
{
    public function addConnection()
    {
        $users = Users::select('user_id', 'username', 'name')->get();
        return view('test.add-connection', [
            'name' => 'Add Connection - SIGMA',
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => [
                'required',
                'string',
                'exists:users,user_id',
                Rule::unique('connections', 'user_id')
            ],
            'is_connect' => 'required|boolean',
            'machine_id' => 'required|string|max:255',
            'date_created' => 'required|string',
            'date_updated' => 'required|string',
        ], [
            'user_id.required' => 'Please select a user.',
            'user_id.exists' => 'Selected user does not exist.',
            'user_id.unique' => 'This user already has a connection record.',
            'is_connect.required' => 'Please select connection status.',
            'machine_id.required' => 'Machine ID is required.',
            'date_created.required' => 'Date created is required.',
            'date_updated.required' => 'Date updated is required.',
        ]);

        try {
            Connection::create([
                'user_id' => $request->user_id,
                'is_connect' => $request->is_connect,
                'machine_id' => $request->machine_id,
                'date_created' => $request->date_created,
                'date_updated' => $request->date_updated,
            ]);

            return redirect()
                ->route('test.add-connection')
                ->with('success', 'Connection record created successfully!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create connection record: ' . $e->getMessage()]);
        }
    }

    public function viewConnections()
    {
        $connections = Connection::with('user')->orderBy('id', 'desc')->get();
        return view('test.view-connections', [
            'name' => 'View Connections - SIGMA',
            'connections' => $connections
        ]);
    }
}