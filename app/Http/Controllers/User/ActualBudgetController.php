<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\EstimatedBudget;
use App\Models\ActualBudget;
use App\Models\ActualBudgetItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActualBudgetController extends Controller
{
    public function create(Request $request)
    {
        $estimates = EstimatedBudget::with('items')
            ->where('user_id', Auth::id())
            ->where('status', 'approved')
            ->latest()
            ->get();

        $estimate = null;
        if ($request->filled('estimate_id')) {
            $estimate = $estimates->firstWhere('id', $request->estimate_id);
        } elseif ($estimates->count() > 0) {
            $estimate = $estimates->first();
        }

        return view('user.actual-budget.create', compact('estimates', 'estimate'));
    }

    public function store(Request $request)
    {
        $estimate = EstimatedBudget::findOrFail($request->estimated_budget_id);

        $actualTotal = 0;
        $items = [];

        foreach ($estimate->items as $item) {
            $rate = (float) $request->input("actual_rate_{$item->id}", 0);
            $qty  = (int) $request->input("actual_qty_{$item->id}", 0);
            $days = (int) $request->input("actual_days_{$item->id}", 0);
            $amt  = $rate * $qty * $days;
            $actualTotal += $amt;

            $items[] = [
                'category'           => $item->category,
                'est_rate'           => $item->rate,
                'est_quantity'       => $item->quantity,
                'est_days_hours'     => $item->days_hours,
                'est_amount'         => $item->amount,
                'actual_rate'        => $rate,
                'actual_quantity'    => $qty,
                'actual_days_hours'  => $days,
                'actual_amount'      => $amt,
            ];
        }

        $advance = $estimate->advance_amount ?? 0;
        $balance = $advance - $actualTotal;
        $deficit = $actualTotal > $advance ? ($actualTotal - $advance) : 0;

        $actual = ActualBudget::create([
            'estimated_budget_id' => $estimate->id,
            'user_id'             => Auth::id(),
            'actual_total'        => $actualTotal,
            'balance'             => $balance,
            'deficit_amount'      => $deficit,
            'prepared_by'         => Auth::user()->name,
        ]);

        $actual->items()->createMany($items);

        return back()->with('success', 'Actual Budget submitted successfully!');
    }
    public function myList()
{
    $actualBudgets = ActualBudget::with('estimatedBudget')
        ->where('user_id', Auth::id())
        ->latest()
        ->paginate(10);

    return view('user.actual-budget.my-list', compact('actualBudgets'));
}

public function show($id)
{
    $actual = ActualBudget::with(['estimatedBudget', 'items'])
        ->where('user_id', Auth::id())
        ->findOrFail($id);

    return view('user.actual-budget.show', compact('actual'));
}
}