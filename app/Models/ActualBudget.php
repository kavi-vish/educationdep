<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActualBudget extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function estimatedBudget()
    {
        return $this->belongsTo(EstimatedBudget::class);
    }

    public function items()
    {
        return $this->hasMany(ActualBudgetItem::class);
    }
}