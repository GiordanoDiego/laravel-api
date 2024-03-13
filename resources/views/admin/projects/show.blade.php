@extends('layouts.app')

@section('page-title', $project->title)

@section('main-content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">
                    {{ $project->title }}
                </h1>

                <h2>
                    Slug: {{ $project->slug }}
                </h2>

                @if ($project->type != null)
                    <h2>
                        Categoria:
                        <a href="{{ route('admin.type.show', ['type' => $project->type->id]) }}">
                            {{ $project->type->name }}
                        </a>
                    </h2>
                @endif

                <p>
                    {{ $project->content }}
                </p>

                <div class="text-center">
                    <a href="{{ route('admin.project.index') }}">Torna indietro</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
