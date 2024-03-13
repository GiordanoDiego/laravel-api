@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center text-success">
                    Tutti i project
                </h1>
                
                <div>
                    <div class="mb-4 text-center">
                        <a href="{{ route('admin.project.create') }}" class="btn btn-primary p-1">
                            Aggiungi progetto
                        </a>
                    </div>
                </div>

                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Type</th>
                                <th scope="col">Technology</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <th scope="row">{{ $project->id }}</th>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->slug }}</td>
                                    <td>
                                        @if ($project->type != null)
                                            <a href="{{ route('admin.type.show', ['type' => $project->type->slug]) }}">
                                                {{ $project->type->name }}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            @foreach ($project->technologies as $technology)
                                                <a href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}" class="badge rounded-pill text-bg-primary">
                                                    {{ $technology->title }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.project.show', ['project' => $project->slug]) }}" class="btn btn-xs btn-primary p-1">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.project.edit', ['project' => $project->slug]) }}" class="btn btn-xs btn-warning p-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form
                                            onsubmit="return confirm('Sei sicuro di voler eliminare il progetto: {{ $project->title }}');"
                                            class="d-inline-block"
                                            action="{{ route('admin.project.destroy', ['project' => $project->slug]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger p-1">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
