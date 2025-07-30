<!DOCTYPE html>
<html lang="pt-br" class="h-full bg-gray-200">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full">
<div class="min-h-full flex flex-col">
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center gap-2">
          <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Logo" class="size-8" />
          <div class="hidden md:flex ml-4 gap-2">
            <a href="{{ route('appointments.index') }}" class="rounded-md px-2 py-2 text-xs md:text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Agendamentos</a>
            <a href="{{ route('clients.index') }}" class="rounded-md px-2 py-2 text-xs md:text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Clientes</a>
            <a href="{{ route('services.index') }}" class="rounded-md px-2 py-2 text-xs md:text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Serviços</a>
            <a href="{{ route('cash_registers.index') }}" class="rounded-md px-2 py-2 text-xs md:text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Caixa</a>
          </div>
        </div>
        <div class="flex items-center gap-2">
          <div class="hidden md:flex items-center gap-2" x-data="{ open: false }">
            <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
              <span class="sr-only">View notifications</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" class="size-6">
                <path d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </button>
            <div class="relative ml-2">
              <button @click="open = !open" class="flex items-center rounded-full bg-gray-800 text-xs md:text-sm focus:outline-none">
                <span class="sr-only">Open user menu</span>
                <img src="https://ui-avatars.com/api/?name=Paulinho&background=4f46e5&color=fff&size=64" alt="Avatar" class="size-8 rounded-full object-cover" />
              </button>
              <div x-show="open" @click.outside="open = false" class="absolute right-0 z-10 mt-2 w-40 md:w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <a href="#" class="block px-4 py-2 text-xs md:text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Seu Perfil</a>
                <a href="#" class="block px-4 py-2 text-xs md:text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Configurações</a>
                <a href="#" class="block px-4 py-2 text-xs md:text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">Sair</a>
              </div>
            </div>
          </div>
          <!-- Mobile menu button -->
          <div class="md:hidden flex items-center" x-data="{ openMobile: false }">
            <button @click="openMobile = !openMobile" class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
              <span class="sr-only">Abrir menu</span>
              <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
            <div x-show="openMobile" @click.outside="openMobile = false" class="absolute top-16 left-0 w-full bg-gray-800 z-50">
              <div class="flex flex-col p-4 space-y-2">
                <a href="{{ route('appointments.index') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Agendamentos</a>
                <a href="{{ route('clients.index') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Clientes</a>
                <a href="{{ route('services.index') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Serviços</a>
                <a href="{{ route('cash_registers.index') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Caixa</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <header class="bg-white shadow-sm w-full">
    <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
      <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900">Paulinho Polimentos</h1>
    </div>
  </header>
  <main class="flex-1 w-full">
    <div class="mx-auto max-w-7xl px-2 sm:px-4 py-4 sm:py-6 lg:px-8">
        @yield('content')
        {{-- Paginação global condicional --}}
        @isset($paginator)
            <div class="mt-6">
                {{ $paginator->links('pagination::tailwind') }}
            </div>
        @endisset
    </div>
  </main>
</div>
</body>
</html>
