<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;
use GrahamCampbell\ResultType\Success;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['type', 'technologies'])->paginate(4);

        return response()->json([
            'success' => true,
            'projects' => $projects,
        ]);
    }
    public function show($slug)
    {
        $projects = Project::with(['type', 'technologies'])->where('slug', $slug)->first();
        if ($projects) {
            return response()->json([
                'success' => true,
                'projects' => $projects,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Not Found Project',
            ]);
        }
    }
}
