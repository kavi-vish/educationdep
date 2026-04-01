<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $primaryKey = 'zone_id';

    protected $fillable = [
        'zone_name'
    ];

    public $timestamps = false;

    // Relationship: One zone has many users
    public function users()
    {
        return $this->hasMany(User::class, 'zone_id');
    }
}