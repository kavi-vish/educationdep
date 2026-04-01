<?php

namespace App\Http\Controllers;
use App\Models\EstimatedBudget;

use Illuminate\Http\Request;

class AccountantController extends Controller
{
    public function dashboard()
    {
        return view('accountant.dashboard');
    }
        public function approvedEstimated()
    {
        $budgets = EstimatedBudget::where('status', 'approved')
                    ->with('user')
                    ->latest()
                    ->paginate(10);

        return view('accountant.estimated.approved', compact('budgets'));
    }
        public function showEstimated($id)
    {
        $budget = EstimatedBudget::with('items')->findOrFail($id);

        return view('accountant.estimated.show', compact('budget'));
    }
}
