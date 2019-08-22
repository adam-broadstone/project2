<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects =  Project::all(); // VARIABLE PROJECTS EQUALS ALL DATA FROM PROJECT TABLE USING ELOQUENT

        return view('projects.index', compact('projects')); // RETURNS VIEW - PROJECT INDEX WITH PROJECTS VARIABLES INFO
    }

    public function show(Project $project) // ROUTE MODEL BINDING ASSIGNS MODEL TO WILDCARD STATEMENT IN ROUTE - AUTO INJECT PROJECT ASSOCIATED WITH WILDCARD
    {


//        $project = Project::findOrFail(request('project')); //FINDS PROJECT WHICH IS THE SAME AS THE WILDCARD NAMES PROJECT ON THE ROUTES PAGE
        return view('projects.show', compact('project')); // REDIRECTS TO PROJECTS/SHOW URL TAKING WITH IT PROJECT INFO
    }

    public function store()
    {

       $attributes = request()->validate([
           'title' => 'required',
           'description' => 'required'
       ]);

        Project::create($attributes);  // NOT SURE WHAT THIS DOES - POSSIBLY ADDS TITLE AND DESCRIPTION TO DATABASE - REFACTORING AT 4:50 on TESTING REQUEST VALIDATION HAS MADE THIS MORE CONFUSING

        return redirect('/projects'); // REDIRECTS TO PROJECTS URL
    }
}
