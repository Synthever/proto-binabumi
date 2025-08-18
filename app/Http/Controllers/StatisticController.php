<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;
use App\Models\Users;
use Illuminate\Validation\Rule;

class StatisticController extends Controller
{
    public function addStatistic()
    {
        $users = Users::select('user_id', 'username', 'name')->get();
        return view('test.add-statistic', [
            'name' => 'Add Statistic - SIGMA',
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users_statistic', 'user_id')
            ],
            'balance' => 'required|string|max:255',
            'poin' => 'required|integer|min:0',
            'bottle_count' => 'required|integer|min:0',
            'date_created' => 'required|string|max:255',
            'date_updated' => 'required|string|max:255',
        ], [
            'user_id.unique' => 'Statistic for this User ID already exists. Please use a different User ID.',
            'user_id.required' => 'User ID is required.',
            'balance.required' => 'Balance is required.',
            'poin.required' => 'Points is required.',
            'poin.integer' => 'Points must be a valid number.',
            'poin.min' => 'Points cannot be negative.',
            'bottle_count.required' => 'Bottle count is required.',
            'bottle_count.integer' => 'Bottle count must be a valid number.',
            'bottle_count.min' => 'Bottle count cannot be negative.',
            'date_created.required' => 'Date created is required.',
            'date_updated.required' => 'Date updated is required.',
        ]);

        try {
            $statistic = Statistic::create([
                'user_id' => $validated['user_id'],
                'balance' => $validated['balance'],
                'poin' => $validated['poin'],
                'bottle_count' => $validated['bottle_count'],
                'date_created' => $validated['date_created'],
                'date_updated' => $validated['date_updated'],
            ]);

            return redirect()->route('test.add-statistic')->with('success', 'User statistic successfully added for User ID: ' . $statistic->user_id);
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to add statistic. Please try again. Error: ' . $e->getMessage()]);
        }
    }

    public function viewStatistics()
    {
        $statistics = Statistic::all();
        return view('test.view-statistics', compact('statistics'));
    }
}