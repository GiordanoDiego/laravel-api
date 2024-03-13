@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
<div class="container">
    <h1 class="text-center">
        Project Create
    </h1>
</div>

<div class="container">
    <div class="row">
        <div class="col py-4">
            <div class="mb-4">
                <a href="{{ route('admin.project.index') }}" class="btn btn-primary">
                    Torna all'index dei projects
                </a>
            </div>
            
            {{-- @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <form action="{{ route('admin.project.store') }}" method="POST">
                @csrf
                {{-- title --}}
                <div class="mb-3">
                    <label for="title" class="form-label">
                        Titolo progetto
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Inserisci il titolo del progetto..." maxlength="1024" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- content --}}
                <div class="mb-3">
                    <label for="content" class="form-label">
                        Descrizione
                        <span class="text-danger">*
                    </label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3" maxlength="4096" placeholder="Inserisci la descrizione..." required>{{ old('content') }}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- tipo --}}
                {{-- tipo --}}
                <div class="mb-3">
                    <label for="type_id" class="form-label">Tipo</label>
                    <select name="type_id" id="type_id" class="form-select">
                        <option value="" {{ old('type_id') == null ? 'selected' : '' }}>
                            Seleziona un tipo...
                        </option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
    
                <div>
                    <button type="submit" class="btn btn-success w-100">
                        + Aggiungi
                    </button>
                </div>
    
            </form>
        </div>
    </div>
</div>
@endsection
