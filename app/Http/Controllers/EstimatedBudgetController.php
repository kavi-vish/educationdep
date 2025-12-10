<?php

namespace App\Http\Controllers;

use App\Models\EstimatedBudget;
use App\Models\EstimatedBudgetItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstimatedBudgetController extends Controller
{
    public function create()
    {
        $zones = ['Galle','Ambalangoda','Elpitiya','Udugama','Matara','Akuressa','Mulatiyana','Deniyaya','Hambantota','Tangalle','Walasmulla'];
        
        $categories = [
            'Resource Allowance 1','Resource Allowance 2','Resource Allowance 3',
            'Workshop supervision','Financial supervision','subject coordinator allowance',
            'subject clerk allowance','Account clerk allowance','K.K.S allowance',
            'Driver allowance','Hall Charges','Refreshment cost','Stationery Cost',
            'Fuel','Other 1','Other 2','Technical support allowance'
        ];

        return view('user.estimated-budget.create', compact('zones', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'zone' => 'required',
            'subject' => 'required',
            'activity_code' => 'required',
            'activity_description' => 'required',
        ]);

        $total = 0;
        $items = [];

        foreach ($request->categories as $i => $cat) {
            $rate = $request->rates[$i] ?? 0;
            $qty  = $request->quantities[$i] ?? 0;
            $days = $request->days_hours[$i] ?? 0;
            $amt  = $rate * $qty * $days;
            $total += $amt;

            // CORRECT WAY – no arrow inside compact()
            $items[] = [
                'category'   => $cat,
                'rate'       => $rate,
                'quantity'   => $qty,
                'days_hours' => $days,
                'amount'     => $amt,
            ];
        }

        $budget = EstimatedBudget::create([
            'user_id'                      => Auth::id(),
            'zone'                         => $request->zone,
            'subject'                      => $request->subject,
            'activity_code'                => $request->activity_code,
            'activity_description'         => $request->activity_description,
            'programme'                    => $request->programme,
            'vote'                         => $request->vote,
            'venue'                        => $request->venue,
            'date'                         => $request->date,
            'funding_source'               => $request->funding_source,
            'estimate_authorization_circular' => $request->estimate_authorization_circular,
            'date_submitted_for_settlement'   => $request->date_submitted_for_settlement,
            'reference_file_no'            => $request->reference_file_no,
            'invited_participants'         => $request->invited_participants,
            'advance_date'                 => $request->advance_date,
            'estimated_total'              => $total,
            'advance_amount'               => $request->advance_amount,
            'total_expenditure'            => $total,
            'balance'                      => $request->balance ?? 0,
            'deficit_amount'               => $request->deficit_amount ?? 0,
            'prepared_by'                  => Auth::user()->name,
            'status'                       => 'pending',
        ]);

        // Save all 17 items in one query
        $budget->items()->createMany($items);

        return redirect()->route('user.estimated-budget.my-list')
               ->with('success', 'Estimated Budget submitted successfully! Waiting for approval.');
    }

    public function myList()
    {
        $budgets = EstimatedBudget::where('user_id', Auth::id())
                     ->with('items')
                     ->latest()
                     ->paginate(10);

        return view('user.estimated-budget.my-list', compact('budgets'));
    }
    public function show($id)
{
    $budget = EstimatedBudget::with('items')->where('user_id', Auth::id())->findOrFail($id);
    return view('user.estimated-budget.show', compact('budget'));
}
}