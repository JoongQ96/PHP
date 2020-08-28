<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // project의 모든 테이블 가져옴
        $projects = \App\Project::all();

        return view('projects.index', [
            'projects' => $projects
        ]);
    }
}
