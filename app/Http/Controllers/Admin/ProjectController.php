<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $types = Type::orderBy('label')->get();
        $technologies = Technology::select('id', 'label')->orderBy('id')->get();
        return view('admin.projects.create', compact('project', 'technologies', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required | string',
            'content' => 'required | string',
            'image' => 'nullable | image',
            'slogan' => 'nullable | string',
            'type_id' => 'nullable | exists:type,id',
            'technologies' => 'nullable | exists:technologies,id'


        ]);

        $data = $request->all();
        $project = new Project();

        if (Arr::exists($data, 'image')) {
            $img_url = Storage::put('projects', $data['image']);
            $data['image'] = $img_url;
        }

        $project->fill($data);
        $project->save();

        // relaziono il project con la technology
        if (Arr::exists($data, 'technologies')) $project->technologies()->attach($data['technologies']);
        return to_route('admin.projects.show', $project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::select('id', 'label')->orderBy('label')->get();
        $technologies = Technology::select('id', 'label')->orderBy('id')->get();
        $project_technologies = $project->technologies->pluck('id')->toArray();
        return view('admin.projects.edit', compact('project', 'technologies', 'types', 'project_technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required | string',
            'content' => 'required | string',
            'image' => 'nullable | image',
            'slogan' => 'nullable | string',
            'type_id' => 'nullable | exists:type,id',
            'technologies' => 'nullable | exists:technologies,id'


        ]);



        $data = $request->all();


        if (Arr::exists($data, 'image')) {
            if ($project->image) Storage::delete($project->image);
            $img_url = Storage::put('projects', $data['image']);
            $data['image'] = $img_url;
        }

        $data['is_published'] = Arr::exists($data, 'is_published');

        $project->fill($data);

        $project->save();

        if (Arr::exists($data, 'technologies')) $project->technologies()->sync($data['technologies']);
        else if (count($project->technologies)) $project->technologies()->detach();

        return to_route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image) Storage::delete($project->image);
        if (count($project->technologies)) $project->technologies()->detach();
        $project->delete();
        return to_route('admin.projects.index');
    }
}
