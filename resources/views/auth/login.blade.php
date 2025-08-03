@extends('layouts.landing')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-indigo-900 to-blue-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Logo e título -->
        <div class="text-center">
            <div class="mx-auto h-20 w-20 flex items-center justify-center rounded-full shadow-lg overflow-hidden">
                <img src="{{ asset('logo.png') }}" alt="Paulinho Polimentos Logo" class="h-20 w-20 object-cover rounded-full">
            </div>
            <h2 class="mt-6 text-3xl font-extrabold text-white">
                Acesso ao Sistema
            </h2>
            <p class="mt-2 text-sm text-blue-200">
                Paulinho Polimentos & Elisa Car-Detail
            </p>
        </div>

        <!-- Formulário de login -->
        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                           class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                           placeholder="Email" value="{{ old('email') }}">
                </div>
                <div>
                    <label for="password" class="sr-only">Senha</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                           class="appearance-none rounded-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                           placeholder="Senha">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-blue-200">
                        Lembrar de mim
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-blue-400 hover:text-blue-300">
                        Esqueceu a senha?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Entrar no Sistema
                </button>
            </div>

            <!-- Mensagens de erro -->
            @if ($errors->any())
                <div class="rounded-md bg-red-50 p-4 mt-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                Erro no login
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul role="list" class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Voltar para página inicial -->
            <div class="text-center">
                <a href="{{ route('welcome') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium transition-colors duration-200">
                    ← Voltar para página inicial
                </a>
            </div>

            <!-- Credenciais de demonstração -->
                {{-- <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <h3 class="text-sm font-semibold text-blue-800 mb-2">🔐 Credenciais de Acesso:</h3>
                    <div class="text-xs text-blue-700 space-y-1">
                        <div><strong>Admin:</strong> admin@paulinho.com / 123456</div>
                        <div><strong>Paulinho:</strong> paulinho@gmail.com / 123456</div>
                        <div><strong>Elisa:</strong> elisa@gmail.com / 123456</div>
                    </div>
                </div> --}}
        </form>
    </div>
</div>
@endsection
