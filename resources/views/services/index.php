@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Serviços</h1>
    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Novo Serviço</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Duração (min)</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->name }}</td>
                <td>R$ {{ number_format($service->price, 2, ',', '.') }}</td>
                <td>{{ $service->duration_minutes }}</td>
                <td>
                    <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('services.destroy', $service) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection