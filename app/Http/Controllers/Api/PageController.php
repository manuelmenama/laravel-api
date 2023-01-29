<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){

        $projects = Project::with(['type', 'tecnologies'])->paginate(6);

        return response()->json(compact('projects'));
    }

    public function show($slug){
        $project = Project::where('slug', $slug)->with(['type', 'tecnologies'])->first();

        if($project->cover_image){
            $project->cover_image = url('storage/'.$project->cover_image);
        }else{
            $project->cover_image = url('storage/uploads/placeholder.webp');

        }

        return response()->json($project);
    }
}
