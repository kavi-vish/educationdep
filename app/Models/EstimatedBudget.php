<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimatedBudget extends Model
{
    use HasFactory;

    protected $guarded = []; // we control via controller

    // app/Models/EstimatedBudget.php

protected $casts = [
    'date'                     => 'date',
    'advance_date'             => 'date',
    'date_submitted_for_settlement' => 'date',
    'estimated_total'          => 'decimal:2',    // ← NEW: total from table
    'total_expenditure'        => 'decimal:2',    // ← Actual spent (user types)
    'advance_amount'           => 'decimal:2',
    'balance'                  => 'decimal:2',
    'deficit_amount'           => 'decimal:2',
];

    // Relationship with items
    public function items()
    {
        return $this->hasMany(EstimatedBudgetItem::class);
    }

    // Relationship with user (user_id → user_id in users table)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Nice badge for status
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending'   => '<span class="badge bg-warning">Pending</span>',
            'approved'  => '<span class="badge bg-success">Approved</span>',
            'rejected'  => '<span class="badge bg-danger">Rejected</span>',
            default     => '<span class="badge bg-secondary">Unknown</span>',
        };
    }
}
