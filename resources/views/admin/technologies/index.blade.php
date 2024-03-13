@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center text-success">
                    Technologies
                </h1>

                <div class="mb-3">
                    <a href="{{ route('admin.technologies.create') }}" class="btn btn-success w-100">
                        + Aggiungi
                    </a>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titolo</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($technologies as $technology)
                            <tr>
                                <th scope="row">{{ $technology->id }}</th>
                                <td>{{ $technology->title }}</td>
                                <td>
                                    <a href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}" class="btn btn-xs btn-primary">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.technologies.edit', ['technology' => $technology->id]) }}" class="btn btn-xs btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form class="d-inline-block" action="{{ route('admin.technologies.destroy', ['technology' => $technology->id]) }}" method="post" onsubmit="return confirm('Vuoi davvero eliminare questa technology?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
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
@endsection
