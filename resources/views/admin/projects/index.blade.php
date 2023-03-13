@extends('layouts.app')



@section('title', 'Projects')

@section('content')

    <header class="d-flex justify-content-between my-4">
        <h1>Projects</h1>
        <a class="btn btn-success" href="{{ route('admin.projects.create') }}">Add Project</a>
    </header>

    <main>
        <div class="project-wrapper d-flex flex-wrap justify-content-center bg-dark">
            @foreach ($projects as $project)
                <div class="card" style="width: 20rem;">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <div class="card-text d-flex justify-content-between">
                            <h5 class="card-title">{{ $project->title }}</h5>
                            <p class="card-type">
                                @if ($project->type)
                                    <span class="badge"
                                        style="background-color:{{ $project->type->color }}">{{ $project->type?->label }}</span>
                                @else
                                    -
                                @endif
                            </p>

                        </div>
                        @if ($project->image)
                            <img class="index-img my-3" src="{{ asset('storage/' . $project->image) }}"
                                alt="{{ $project->title }}">
                        @endif
                        <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-primary">Details</a>
                    </div>
                </div>
            @endforeach


        </div>
    </main>
@endsection
