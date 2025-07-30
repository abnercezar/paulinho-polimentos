<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paulinho Polimentos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-[#FDFDFC] text-[#1b1b18] flex items-center justify-center min-h-screen flex-col">
    <img src="{{ asset('logo.png') }}" alt="Logo Paulinho Polimentos" style="max-width:200px; margin-bottom:2rem;">
    <h1 class="text-3xl font-bold mb-4">Bem-vindo ao Sistema de Agendamentos</h1>
    <p class="text-lg mb-6">Paulinho Polimentos</p>
    <a href="{{ route('appointments.index') }}" class="btn btn-primary">Acessar Agendamentos</a>
</body>
</html>
