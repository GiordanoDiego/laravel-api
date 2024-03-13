@extends('layouts.app')

@section('page-title', 'Technologies Create')

@section('main-content')
<h1>
    Technologies Create
</h1>

<div class="row">
    <div class="col py-4">
        <div class="mb-4">
            <a href="{{ route('admin.technologies.index') }}" class="btn btn-primary">
                Torna all'index
            </a>
        </div>

        <form action="{{ route('admin.technologies.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Inserisci il titolo..." maxlength="255" required>
            </div>

            <div>
                <button type="submit" class="btn btn-success w-100">
                    + Aggiungi
                </button>
            </div>

        </form>
    </div>
</div>
@endsection