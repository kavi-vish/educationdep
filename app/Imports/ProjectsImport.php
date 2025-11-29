<?php

namespace App\Imports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;

class ProjectsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    public function model(array $row)
    {
        return new Project([
            'strategy'            => $row['strategy'] ?? null,
            'activity_no'         => $row['activity_no'] ?? null,
            'activity_description'=> $row['activities_sub_activities'] ?? null,
            'location'            => $row['location'] ?? null, // Match header
            'q1'                  => $row['q1'] ?? null,
            'q2'                  => $row['q2'] ?? null,
            'q3'                  => $row['q3'] ?? null,
            'q4'                  => $row['q4'] ?? null,
            'budget_head'         => $row['budget_head'] ?? null,
            'programme'           => $row['programme'] ?? null,
            'project'             => $row['project'] ?? null,
            'object_code'         => $row['object_code'] ?? null,
            'no_of_units'         => $row['no_of_units'] ?? null,
            'unit_cost'           => $row['unit_cost_rs_000'] ?? null, // Match header
            'estimated_cost_r'    => $row['estimated_cost_r'] ?? null,
            'estimated_cost_c'    => $row['estimated_cost_c'] ?? null,
            'estimated_cost_t'    => $row['estimated_cost_t'] ?? null,
            'kpi'                 => $row['key_performance_indicator'] ?? null,
            'funding_source'      => $row['source_of_funding'] ?? null,
            'reference_plan'      => $row['reference_to_sdg_proc_ument_plan'] ?? null,
            'galle'               => $row['galle'] ?? 0,
            'ambalangoda'         => $row['ambalangoda'] ?? 0,
            'elipitiya'           => $row['elipitiya'] ?? 0,
            'udugama'             => $row['udugama'] ?? 0,
            'matara'              => $row['matara'] ?? 0,
            'akurassa'            => $row['akurassa'] ?? 0,
            'mulkirigala'         => $row['mulkirigala'] ?? 0,
            'deniyaya'            => $row['deniyaya'] ?? 0,
            'hambantota'          => $row['hambantota'] ?? 0,
            'tangalle'            => $row['tangalle'] ?? 0,
            'walasmulla'          => $row['walasmulla'] ?? 0,
            'pde'                 => $row['pde'] ?? 0,
            'total'               => $row['total'] ?? 0,
            'status'              => $row['status'] ?? 'Pending',
        ]);
    }

    public function rules(): array
    {
        return [
            '*.strategy' => 'nullable|string|max:255',
            '*.activity_no' => 'required|string|max:50',
            '*.activities_sub_activities' => 'required|string',
            '*.location'                  => 'nullable|string|max:255',
            '*.q1' => 'nullable|string',
            '*.q2' => 'nullable|string',
            '*.q3' => 'nullable|string',
            '*.q4' => 'nullable|string',
            '*.budget_head' => 'required|string|max:50',
            '*.programme' => 'required|string|max:50',
            '*.project' => 'required|string|max:50',
            '*.object_code' => 'required|string|max:50',
            '*.no_of_units' => 'nullable|integer',
            '*.unit_cost_rs_000' => 'nullable|numeric',
            '*.estimated_cost_r' => 'nullable|numeric',
            '*.estimated_cost_c' => 'nullable|numeric',
            '*.estimated_cost_t' => 'nullable|numeric',
            '*.key_performance_indicator' => 'nullable|string|max:255',
            '*.source_of_funding' => 'nullable|string|max:50',
            '*.reference_to_sdg_proc_ument_plan' => 'nullable|string|max:100',
            '*.galle' => 'nullable|numeric',
            '*.ambalangoda' => 'nullable|numeric',
            '*.elipitiya' => 'nullable|numeric',
            '*.udugama' => 'nullable|numeric',
            '*.matara' => 'nullable|numeric',
            '*.akurassa' => 'nullable|numeric',
            '*.mulkirigala' => 'nullable|numeric',
            '*.deniyaya' => 'nullable|numeric',
            '*.hambantota' => 'nullable|numeric',
            '*.tangalle' => 'nullable|numeric',
            '*.walasmulla' => 'nullable|numeric',
            '*.pde' => 'nullable|numeric',
            '*.total' => 'nullable|numeric',
            '*.status' => 'nullable|in:Pending,Approved,Rejected,Completed',
        ];
    }

    public function onError(Throwable $e)
    {
        // Skip bad rows silently
    }
}