<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstimatedBudget;
use App\Models\ActualBudget;
use App\Models\User;
use App\Models\Vote;
use App\Models\FundAllocation;


class AdminBudgetController extends Controller
{
    // Estimated Budgets List
    public function estimatedList()
    {
        $budgets = EstimatedBudget::with('user')->latest()->paginate(15);
        return view('admin.estimated.list', compact('budgets'));
    }

    public function estimatedShow($id)
    {
        $budget = EstimatedBudget::with('items')->findOrFail($id);
        return view('admin.estimated.show', compact('budget'));
    }

    public function estimatedApprove($id)
    {
        $budget = EstimatedBudget::findOrFail($id);
        $budget->status = 'approved';
        $budget->save();
        return back()->with('success', 'Estimated Budget Approved Successfully!');
    }

    public function estimatedReject($id)
    {
        $budget = EstimatedBudget::findOrFail($id);
        $budget->status = 'rejected';
        $budget->save();
        return back()->with('success', 'Estimated Budget Rejected!');
    }

    // Actual Budgets List
    public function actualList()
    {
        $budgets = ActualBudget::with(['estimatedBudget.user'])->latest()->paginate(15);
        return view('admin.actual.list', compact('budgets'));
    }

    public function actualShow($id)
    {
        $actual = ActualBudget::with(['estimatedBudget.items', 'items'])->findOrFail($id);
        return view('admin.actual.show', compact('actual'));
    }

public function actualApprove($id)
{
    $actual = ActualBudget::findOrFail($id);
    $actual->status = 'approved';
    $actual->save();

    // Update ONLY if vote matches
    if ($actual->estimatedBudget->vote) {
        $vote = Vote::where('vote_number', $actual->estimatedBudget->vote)->first();
        if ($vote) {
            $vote->updateBalance();
        }
    }

    return back()->with('success', 'Actual Budget Approved! Vote balance updated if applicable.');
}

public function actualReject($id)
{
    $actual = ActualBudget::findOrFail($id);
    $oldVote = $actual->estimatedBudget->vote;
    $actual->status = 'rejected';
    $actual->save();

    // Recalculate balance for the vote (since used amount is removed)
    if ($oldVote) {
        $vote = Vote::where('vote_number', $oldVote)->first();
        if ($vote) {
            $vote->updateBalance();
        }
    }

    return back()->with('success', 'Actual Budget Rejected! Vote balance updated.');
}
    public function voteManagement()
{
    $votes = Vote::with('allocations')->get();
    return view('admin.votes.index', compact('votes'));
}

public function createVote(Request $request)
{
    $request->validate([
        'vote_number' => 'required|unique:votes',
        'description' => 'required',
    ]);

    Vote::create($request->all());

    return back()->with('success', 'Vote created successfully!');
}

public function addFund(Request $request)
{
    $request->validate([
        'vote_id' => 'required|exists:votes,id',
        'year' => 'required|integer',
        'month' => 'required|integer|min:1|max:12',
        'amount' => 'required|numeric|min:0',
        'remarks' => 'nullable|string',
    ]);

    FundAllocation::create($request->all());

    return back()->with('success', 'Fund added successfully!');
}
}
