@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Serviço</h1>
        <form action="{{ route('services.update', $service) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $service->name }}" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Preço</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ $service->price }}" required>
            </div>
            <div class="mb-3">
                <label for="duration_minutes" class="form-label">Duração (minutos)</label>
                <input type="number" name="duration_minutes" id="duration_minutes" class="form-control" value="{{ $service->duration_minutes }}" required>
            </div>
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
