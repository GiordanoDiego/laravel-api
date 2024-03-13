@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center text-success">
                    Tutti i type
                </h1>
                
                <div>
                    <div class="mb-4 text-center">
                        <a href="{{ route('admin.type.create') }}" class="btn btn-primary p-1">
                            Aggiungi un tipo
                        </a>
                    </div>
                </div>

                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $type)
                                <tr>
                                    <th scope="row">{{ $type->id }}</th>
                                    <td>{{ $type->name }}</td>
                                    <td>{{ $type->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.type.show', ['type' => $type->slug]) }}" class="btn btn-xs btn-primary p-1">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.type.edit', ['type' => $type->slug]) }}" class="btn btn-xs btn-warning p-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form
                                            onsubmit="return confirm('Sei sicuro di voler eliminare il progetto: {{ $type->name }}');"
                                            class="d-inline-block"
                                            action="{{ route('admin.type.destroy', ['type' => $type->slug]) }}"
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
