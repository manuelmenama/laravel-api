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

        if($project->image){
            $project->image = url('storage/uploads/'.$project->cover_image);
        }else{
            $project->image = url('storage/uploads/placeholder.webp');

        }

        return response()->json($project);
    }
}
