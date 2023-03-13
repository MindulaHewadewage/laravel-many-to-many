@extends('layouts.app')



@section('title', 'Projects')

@section('content')
    <header>
        <h1 class="my-3">Add Project</h1>
    </header>


    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            {{-- TITLE --}}
            <div class="col-6">
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="title" placeholder="Choose a title" name="title"
                        required value="{{ old('title') }}">
                </div>
            </div>

            {{-- SLOGAN --}}
            <div class="col-6">
                <div class="mb-3">
                    <label for="slogan" class="form-label">Slogan:</label>
                    <input type="text" class="form-control" id="slogan" placeholder="Choose a slogan" name="slogan"
                        value="{{ old('slogan') }}">
                </div>
            </div>

            {{-- TYPE --}}
            <div class="col-4">
                <div class="mb-3">
                    <label for="type_id" class="form-label">Type:</label>
                    <select class="form-select" name="type_id" id="type_id">
                        <option value="">No Type </option>
                        @foreach ($types as $type)
                            <option @if ($project->type_id == $type->id) selected @endif value="{{ $type->id }}">
                        @endforeach

                    </select>
                </div>
            </div>

            {{-- IMAGE --}}
            <div class="col-7">
                <div class="mb-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control" id="image" placeholder="Choose an image" name="image"
                        value="{{ old('image') }}">
                </div>
            </div>

            {{-- PLACEHOLDER --}}
            <div class="col-1">
                <img class="img-preview "
                    src="{{ $project->image ? asset('storage/' . $project->image) : 'https://www.studioandreaciucci.it/wp-content/uploads/2017/12/placeholder.png' }}"
                    alt="">
            </div>

            {{-- CONTENT --}}
            <div class="col-12">
                <div class="mb-3">
                    <label for="content" class="form-label">Content:</label>
                    <textarea type="text" class="form-control" id="content" placeholder="Choose a content" name="content" required>{{ old('content') }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end ">
                <a href="{{ route('admin.projects.index') }}" class="btn  btn-secondary mx-2"><i
                        class="fa-sharp fa-solid fa-rotate-left"></i></a>
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i></button>

            </div>




    </form>
@endsection
