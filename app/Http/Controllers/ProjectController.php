<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Exports\ProjectsExport;
use App\Imports\ProjectsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(50);
        return view('admin.projects', compact('projects'));
    }

    public function export()
    {
        return Excel::download(new ProjectsExport, 'projects.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:10240',
        ]);

        Excel::import(new ProjectsImport, $request->file('file'));

        return back()->with('success', 'Projects imported successfully.');
    }
}