<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Tecnology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Psy\CodeCleaner\ReturnTypePass;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['search'])){
            $searched = $_GET['search'];
            $projects = Project::where('name','like',"%$searched%")->paginate(10);
        }else{
            $projects = Project::orderBy('id', 'desc')->paginate(10);
        }

        $direction = 'desc';
        return view('admin.projects.projects', compact('projects', 'direction'));
    }

    public function orderby($column, $direction){
        $direction = $direction === 'desc'?'asc':'desc';
        $projects = Project::orderBy($column, $direction)->paginate(10);
        return view('admin.projects.projects', compact('projects', 'direction'));
    }

    public function project_type(){
        $types = Type::all();
        return view('admin.projects.list_type_project', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $types = Type::all();
        $tecnologies = Tecnology::all();
        return view('admin.projects.create', compact('types', 'tecnologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project_data = $request->all();
        //dd($project_data);

        $project_data['slug'] = Project::generateSlug($project_data['name']);

        if(array_key_exists('cover_image', $project_data)){
            $project_data['image_original_name'] = $request->file('cover_image')->getClientOriginalName();
            $project_data['cover_image'] = Storage::put('uploads', $project_data['cover_image']);
        }

        //dd($project_data);

        $new_project = new Project();
        $new_project->fill($project_data);
        $new_project->save();
        //$new_project = Project::create($project_data);

        if(array_key_exists('tecnologies', $project_data)){
            $new_project->tecnologies()->attach($project_data['tecnologies']);
        }

        return redirect()->route('admin.project.show', $new_project)->with('message', "Progetto inserito correttamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $tecnologies = Tecnology::all();
        return view('admin.projects.edit', compact('project', 'types', 'tecnologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project_data = $request->all();
        if($project_data['name'] != $project->name){
            $project_data['slug'] = Project::generateSlug($project_data['name']);
        }else{
            $project_data['slug'] = $project->slug;
        }

        if(array_key_exists('cover_image', $project_data)){
            //se esiste allora devo eliminare la vecchia immagine
            if($project->cover_image){

                Storage::disk('public')->delete($project->cover_image);
            }
            $project_data['image_original_name'] = $request->file('cover_image')->getClientOriginalName();
            $project_data['cover_image'] = Storage::put('uploads', $project_data['cover_image']);
        }

        if(array_key_exists('tecnologies', $project_data)){
            $project->tecnologies()->sync($project_data['tecnologies']);
        }else{
            // $project->tecnologies()->sync([]);
            $project->tecnologies()->detach();
        }

        $project->update($project_data);
        return redirect()->route('admin.project.show', $project)->with('message', "Progetto modificato correttamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->cover_image){

            Storage::disk('public')->delete($project->cover_image);
        }

        $project->delete();

        return redirect()->route('admin.project.index')->with('deleted', "Progetto eliminato correttamente");
    }
}
