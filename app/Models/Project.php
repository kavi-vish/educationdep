<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $primaryKey = 'project_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'strategy', 'activity_no', 'activity_description','location',
        'q1', 'q2', 'q3', 'q4',
        'budget_head', 'programme', 'project', 'object_code',
        'no_of_units', 'unit_cost',
        'estimated_cost_r', 'estimated_cost_c', 'estimated_cost_t',
        'kpi', 'funding_source', 'reference_plan',
        'galle', 'ambalangoda', 'elipitiya', 'udugama', 'matara', 'akurassa',
        'mulkirigala', 'deniyaya', 'hambantota', 'tangalle', 'walasmulla', 'pde',
        'total', 'status',
    ];

    protected $casts = [
        'unit_cost'        => 'decimal:2',
        'estimated_cost_r' => 'decimal:2',
        'estimated_cost_c' => 'decimal:2',
        'estimated_cost_t' => 'decimal:2',
        'galle'            => 'decimal:2',
        'ambalangoda'      => 'decimal:2',
        'elipitiya'        => 'decimal:2',
        'udugama'          => 'decimal:2',
        'matara'           => 'decimal:2',
        'akurassa'         => 'decimal:2',
        'mulkirigala'      => 'decimal:2',
        'deniyaya'         => 'decimal:2',
        'hambantota'       => 'decimal:2',
        'tangalle'         => 'decimal:2',
        'walasmulla'       => 'decimal:2',
        'pde'              => 'decimal:2',
        'total'            => 'decimal:2',
    ];
}