<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects/projectList', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();

        return view('projects/projectForm', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['string', 'required'],
            'status' => ['string', 'required'],
            'price' => ['numeric', 'required'],
            'service_id' => ['numeric', 'required'],
            'user_id' => ['numeric', 'required', Rule::exists('users', 'id')],
        ]);

        Project::create($request->all());

        $projects = Project::all();

        return view('projects/projectList', compact('projects'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {

        $services = Service::all();

        return view('projects/projectForm', compact('project', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => ['string', 'required'],
            'status' => ['string', 'required'],
            'price' => ['numeric', 'required'],
            'service_id' => ['numeric', 'required'],
            'user_id' => ['numeric', 'required', Rule::exists('users', 'id')],
        ]);

        $project->name = $request->name;
        $project->status = $request->status;
        $project->price = $request->price;
        $project->service_id = $request->service_id;
        $project->user_id = $request->user_id;

        $project->save();

        $projects = Project::all();

        return view('projects/projectList', compact('projects'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        $projects = Project::all();

        return view('projects/projectList', compact('projects'));
        
        return view('projects/projectList', compact('projects'));
    }
}
