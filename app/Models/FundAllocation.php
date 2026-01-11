<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FundAllocation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vote()
    {
        return $this->belongsTo(Vote::class);
    }

    protected static function booted()
{
    static::created(function ($allocation) {
        $vote = $allocation->vote;
        $vote->total_allocated += $allocation->amount;
        $vote->updateBalance(); // Recalculate remaining
    });
}
}