<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimatedBudgetItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'rate'       => 'decimal:2',
        'quantity'   => 'integer',
        'days_hours' => 'integer',
        'amount'     => 'decimal:2',
    ];

    public function budget()
    {
        return $this->belongsTo(EstimatedBudget::class);
    }
}
