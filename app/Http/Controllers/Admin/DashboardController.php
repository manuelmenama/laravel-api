<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $project_counter = Project::count();

        //dd($project_counter);

        return view('admin.home', compact('project_counter'));
    }




}
