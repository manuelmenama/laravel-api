<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){

        $projects = Project::with(['type', 'tecnologies', 'user'])->paginate(6);

        $types = Type::all();

        return response()->json(compact('projects', 'types'));
    }

    public function show($slug){
        $project = Project::where('slug', $slug)->with(['type', 'tecnologies', 'user'])->first();

        if($project->cover_image){
            $project->cover_image = url('storage/'.$project->cover_image);
        }else{
            $project->cover_image = url('storage/uploads/placeholder.webp');

        }

        return response()->json($project);
    }

    public function search() {
        $searched = $_GET['searched'];

        $searched_project = Project::where('name', 'like', "%$searched%")->with(['type', 'tecnologies', 'user'])->get();

        return response()->json(compact('searched_project'));
    }

    public function getByType($id){
        $projects = Project::where('type_id', $id)->with(['type', 'tecnologies', 'user'])->get();

        return response()->json(compact('projects'));
    }
}
//funzione per cercare i post con tag
/*
$posts = Post::with(['tags','category','user'])
            ->whereHas('tags', function (Builder $query) use($id){

                $query->where('tag_id', $id);

            })
            ->get();
*/
