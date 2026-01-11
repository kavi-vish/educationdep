<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function allocations()
    {
        return $this->hasMany(FundAllocation::class);
    }

    public function updateBalance()
{
    // Only approved Actual Budgets where vote matches this vote_number
    $used = ActualBudget::where('status', 'approved')
        ->whereHas('estimatedBudget', function ($query) {
            $query->where('vote', $this->vote_number);
        })
        ->sum('actual_total');

    $this->total_used = $used;
    $this->remaining = $this->total_allocated - $used;
    $this->save();
}
}