<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class Projectcontroller extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
       $projects= Project::orderBy('id')->get();

        return view('projects.index',compact('projects'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
        // ?

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Project $project): View
    {
        return view('projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'name' => 'required',
            'active' => 'required|boolean',
            'code' => 'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'max_hours'=>'required'
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')
                        ->with('success','Project created successfully.');
    }

        // Hier worden de producten opgeslagen met een functie


    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project): View
    {
        return view('projects.show',compact('project'));
    }
        // Dit stuurt je naar een view


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project): View
    {
        // var_dump($project); die;
        return view('projects.edit',compact('project'));
    }
        // Dit stuurt je naar een view


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project): RedirectResponse
    {


         request()->validate([
            'name' => 'required',
            'active' => 'required|boolean',
            'code' => 'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'max_hours'=>'required'
        ]);

        // Validator::make($data, [ 'appointment_date' => 'required|date_format:d-m-Y', 'from_time' => 'required|date_format:H:i', 'to_time' => 'required|date_format:H:i', ]);

        $project->update($request->all());

        return redirect()->route('projects.index')
                        ->with('success','Project updated successfully');
    }
        // Hier worden de Projecten geupdate met de nieuwe gegevens


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('project.index')
                        ->with('success','Project deleted successfully');
    }
        // Delete functie om Projecten mee wegte gooien.
}
