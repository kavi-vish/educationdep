<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Project::select([
            'strategy', 'activity_no', 'activity_description','location',
            'q1', 'q2', 'q3', 'q4',
            'budget_head', 'programme', 'project', 'object_code',
            'no_of_units', 'unit_cost',
            'estimated_cost_r', 'estimated_cost_c', 'estimated_cost_t',
            'kpi', 'funding_source', 'reference_plan',
            'galle', 'ambalangoda', 'elipitiya', 'udugama', 'matara', 'akurassa',
            'mulkirigala', 'deniyaya', 'hambantota', 'tangalle', 'walasmulla', 'pde',
            'total', 'status', 'created_at', 'updated_at'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Strategy', 'Activity No', 'Activities/Sub Activities','location',
            'Q1', 'Q2', 'Q3', 'Q4',
            'Budget Head', 'Programme', 'Project', 'Object Code',
            'No of Units', 'Unit Cost Rs.\'000',
            'Estimated Cost R', 'Estimated Cost C', 'Estimated Cost T',
            'Key Performance Indicator', 'Source of Funding', 'Reference to SDG/Proc ument plan',
            'Galle', 'Ambalangoda', 'Elipitiya', 'Udugama', 'Matara', 'Akurassa',
            'Mulkirigala', 'Deniyaya', 'Hambantota', 'Tangalle', 'Walasmulla', 'PDE',
            'Total', 'Status', 'Created At', 'Updated At'
        ];
    }
}