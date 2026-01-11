<?php

namespace App\Imports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\Failure;

class ProjectsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
     * Map each row to a new Project model
     */
    public function model(array $row)
    {
        return new Project([
            'strategy'              => $row['strategy'] ?? null,
            'activity_no'           => $row['activity_no'] ?? null,
            'activity_description'  => $row['activity_description'] ?? null,
            'location'              => $row['location'] ?? null,

            'q1'                    => $this->toNumeric($row['q1'] ?? null),
            'q2'                    => $this->toNumeric($row['q2'] ?? null),
            'q3'                    => $this->toNumeric($row['q3'] ?? null),
            'q4'                    => $this->toNumeric($row['q4'] ?? null),

            'budget_head'           => $this->toInteger($row['budget_head'] ?? null),
            'programme'             => $row['programme'] ?? null,
            'project'               => $row['project'] ?? null,
            'object_code'           => $this->toInteger($row['object_code'] ?? null),
            'no_of_units'           => $this->toInteger($row['no_of_units'] ?? null),

            'unit_cost'             => $this->toNumeric($row['unit_cost'] ?? null),

            'estimated_cost_r'      => $this->toNumeric($row['estimated_cost_r'] ?? null),
            'estimated_cost_c'      => $this->toNumeric($row['estimated_cost_c'] ?? null),
            'estimated_cost_t'      => $this->toNumeric($row['estimated_cost_t'] ?? null),

            'kpi'                   => $row['kpi'] ?? null,
            'funding_source'        => $row['funding_source'] ?? null,
            'reference_plan'        => $row['reference_plan'] ?? null,

            'galle'                 => $this->toNumeric($row['galle'] ?? 0),
            'ambalangoda'           => $this->toNumeric($row['ambalangoda'] ?? 0),
            'elipitiya'             => $this->toNumeric($row['elipitiya'] ?? 0),
            'udugama'               => $this->toNumeric($row['udugama'] ?? 0),
            'matara'                => $this->toNumeric($row['matara'] ?? 0),
            'akurassa'              => $this->toNumeric($row['akurassa'] ?? 0),
            'mulkirigala'           => $this->toNumeric($row['mulkirigala'] ?? 0),
            'deniyaya'              => $this->toNumeric($row['deniyaya'] ?? 0),
            'hambantota'            => $this->toNumeric($row['hambantota'] ?? 0),
            'tangalle'              => $this->toNumeric($row['tangalle'] ?? 0),
            'walasmulla'            => $this->toNumeric($row['walasmulla'] ?? 0),
            'pde'                   => $this->toNumeric($row['pde'] ?? 0),

            'total'                 => $this->toNumeric($row['total'] ?? 0),
            'status'                => $row['status'] ?? 'Pending',
        ]);
    }

    /**
     * Validation rules based on database schema
     */
    public function rules(): array
    {
        return [
            '*.activity_no'           => 'required|string|max:50',
            '*.activity_description'  => 'nullable|string',
            '*.strategy'              => 'nullable|string',
            '*.location'              => 'nullable|string|max:255',

            '*.q1'                    => 'nullable|numeric',
            '*.q2'                    => 'nullable|numeric',
            '*.q3'                    => 'nullable|numeric',
            '*.q4'                    => 'nullable|numeric',

            '*.budget_head'           => 'nullable|integer',
            '*.programme'             => 'nullable|string|max:50',
            '*.project'               => 'nullable|string|max:50',
            '*.object_code'           => 'nullable|integer',
            '*.no_of_units'           => 'nullable|integer',

            '*.unit_cost'             => 'nullable|numeric',

            '*.estimated_cost_r'      => 'nullable|numeric',
            '*.estimated_cost_c'      => 'nullable|numeric',
            '*.estimated_cost_t'      => 'nullable|numeric',

            '*.kpi'                   => 'nullable|string|max:255',
            '*.funding_source'        => 'nullable|string|max:50',
            '*.reference_plan'        => 'nullable|string|max:100',

            '*.galle'                 => 'nullable|numeric',
            '*.ambalangoda'           => 'nullable|numeric',
            '*.elipitiya'             => 'nullable|numeric',
            '*.udugama'               => 'nullable|numeric',
            '*.matara'                => 'nullable|numeric',
            '*.akurassa'              => 'nullable|numeric',
            '*.mulkirigala'           => 'nullable|numeric',
            '*.deniyaya'              => 'nullable|numeric',
            '*.hambantota'            => 'nullable|numeric',
            '*.tangalle'              => 'nullable|numeric',
            '*.walasmulla'            => 'nullable|numeric',
            '*.pde'                   => 'nullable|numeric',

            '*.total'                 => 'nullable|numeric',
            '*.status'                => 'nullable|in:Pending,Approved,Rejected,Completed',
        ];
    }

    /**
     * Helper: safely convert to numeric
     */
    private function toNumeric($value)
    {
        if ($value === null || $value === '') {
            return null;
        }
        return is_numeric($value) ? (float) $value : null;
    }

    /**
     * Helper: safely convert to integer
     */
    private function toInteger($value)
    {
        if ($value === null || $value === '') {
            return null;
        }
        return filter_var($value, FILTER_VALIDATE_INT) !== false ? (int) $value : null;
    }

    /**
     * Optional: Handle collected failures (e.g., log them)
     */
    public function onFailure(Failure ...$failures)
    {
        // You can log failures here if needed
        // \Log::error('Import failures:', $failures);
    }
}