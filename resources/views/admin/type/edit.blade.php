@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
<div class="container">
    <h1 class="text-center">
        Type Edit
    </h1>
</div>

<div class="container">
    <div class="row">
        <div class="col py-4">
            <div class="mb-4">
                <a href="{{ route('admin.type.index') }}" class="btn btn-primary">
                    Torna all'index dei Type
                </a>
            </div>


            <form action="{{ route('admin.type.update', ['type' => $type->id]) }}" method="POST">
                
                @csrf
                @method('PUT')
                
                {{-- name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input  type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome del tipo..." maxlength="1024" value="{{ old('name', $type->name) }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                
    
                <div>
                    <button type="submit" class="btn btn-success w-100">
                        modifica
                    </button>
                </div>
    
            </form>
        </div>
    </div>
</div>
@endsection
