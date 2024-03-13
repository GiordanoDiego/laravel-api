@extends('layouts.app')

@section('page-title', $type->name)

@section('main-content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">
                    {{ $type->name }}
                </h1>

                <span>
                    Slug: {{ $type->slug }}
                </span>

                <h2 class="text-center text-success">
                    Progetti con questo tipo
                </h2>
                
                <ul>
                    @if ($type->projects)
                        @foreach ($type->projects as $project)
                            <li>
                                <a href="{{ route('admin.project.show', ['project' => $project->slug]) }}">
                                    {{ $project->title }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>

                

                <div class="text-center">
                    <a href="{{ route('admin.type.index') }}">Torna indietro</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
