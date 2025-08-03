<!DOCTYPE html>
<html lang="pt-br" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>{{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Customizações para mobile */
        @media (max-width: 768px) {
            .mobile-table {
                font-size: 12px;
            }
            .mobile-modal {
                margin: 8px;
                max-height: calc(100vh - 16px);
                overflow-y: auto;
            }
            .mobile-btn {
                min-height: 44px;
                min-width: 44px;
            }
            /* Touch-friendly interactions */
            button, a, input, select, textarea {
                min-height: 44px;
                min-width: 44px;
            }
            /* Better scrolling on mobile */
            .mobile-scroll {
                -webkit-overflow-scrolling: touch;
            }
            /* Improved form inputs on mobile */
            input[type="text"],
            input[type="email"],
            input[type="tel"],
            input[type="number"],
            input[type="datetime-local"],
            select,
            textarea {
                font-size: 16px; /* Prevents zoom on iOS */
                border-radius: 8px;
                padding: 12px 16px;
            }
            /* FAB button */
            .fab {
                position: fixed;
                bottom: 20px;
                right: 20px;
                width: 56px;
                height: 56px;
                border-radius: 50%;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                z-index: 1000;
            }
        }
        /* Scrollbar customizado */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }
        /* Improved focus styles for accessibility */
        button:focus-visible,
        a:focus-visible,
        input:focus-visible,
        select:focus-visible,
        textarea:focus-visible {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }
        /* Loading states */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }
        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body class="h-full m-0 p-0 bg-gray-50">
<div class="min-h-full flex flex-col">
  <nav class="bg-gray-800 sticky top-0 z-40">
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
      <div class="flex h-14 sm:h-16 items-center justify-between">
        <div class="flex items-center gap-2">
          <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Logo" class="w-6 h-6 sm:w-8 sm:h-8" />
          <div class="hidden md:flex ml-4 gap-1 lg:gap-2">
            <a href="{{ route('appointments.index') }}" class="rounded-md px-2 py-2 text-xs lg:text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">Agendamentos</a>
            <a href="{{ route('clients.index') }}" class="rounded-md px-2 py-2 text-xs lg:text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">Clientes</a>
            <a href="{{ route('services.index') }}" class="rounded-md px-2 py-2 text-xs lg:text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">Serviços</a>
            <a href="{{ route('cash_registers.index') }}" class="rounded-md px-2 py-2 text-xs lg:text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">Caixa</a>
          </div>
        </div>
        <div class="flex items-center gap-2">
          <div class="hidden md:flex items-center gap-2" x-data="{ open: false }">
            <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 transition-colors">
              <span class="sr-only">Ver notificações</span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true" class="w-5 h-5 lg:w-6 lg:h-6">
                <path d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </button>
            <div class="relative ml-2">
              <button @click="open = !open" class="flex items-center rounded-full bg-gray-800 text-xs lg:text-sm focus:outline-none transition-transform hover:scale-105">
                <span class="sr-only">Abrir menu do usuário</span>
                <img src="https://ui-avatars.com/api/?name=Paulinho&background=4f46e5&color=fff&size=64" alt="Avatar" class="w-6 h-6 lg:w-8 lg:h-8 rounded-full object-cover" />
              </button>
              <div x-show="open"
                   x-transition:enter="transition ease-out duration-100"
                   x-transition:enter-start="transform opacity-0 scale-95"
                   x-transition:enter-end="transform opacity-100 scale-100"
                   x-transition:leave="transition ease-in duration-75"
                   x-transition:leave-start="transform opacity-100 scale-100"
                   x-transition:leave-end="transform opacity-0 scale-95"
                   @click.outside="open = false"
                   class="absolute right-0 z-10 mt-2 w-40 lg:w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5"
                   role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <a href="#" class="block px-4 py-2 text-xs lg:text-sm text-gray-700 hover:bg-gray-100 transition-colors" role="menuitem" tabindex="-1">Seu Perfil</a>
                <a href="#" class="block px-4 py-2 text-xs lg:text-sm text-gray-700 hover:bg-gray-100 transition-colors" role="menuitem" tabindex="-1">Configurações</a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                  @csrf
                  <button type="submit" class="w-full text-left px-4 py-2 text-xs lg:text-sm text-gray-700 hover:bg-gray-100 transition-colors" role="menuitem" tabindex="-1">Sair</button>
                </form>
              </div>
            </div>
          </div>
          <!-- Mobile menu button -->
          <div class="md:hidden flex items-center" x-data="{ openMobile: false }">
            <button @click="openMobile = !openMobile"
                    class="mobile-btn inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 transition-colors">
              <span class="sr-only">Abrir menu</span>
              <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path x-show="!openMobile" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="openMobile" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
            <div x-show="openMobile"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 -translate-y-2"
                 x-transition:enter-end="transform opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 translate-y-0"
                 x-transition:leave-end="transform opacity-0 -translate-y-2"
                 @click.outside="openMobile = false"
                 class="absolute top-14 sm:top-16 left-0 right-0 bg-gray-800 z-50 shadow-lg">
              <div class="flex flex-col p-4 space-y-1">
                <a href="{{ route('appointments.index') }}" class="mobile-btn rounded-md px-3 py-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">📅 Agendamentos</a>
                <a href="{{ route('clients.index') }}" class="mobile-btn rounded-md px-3 py-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">👥 Clientes</a>
                <a href="{{ route('services.index') }}" class="mobile-btn rounded-md px-3 py-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">✂️ Serviços</a>
                <a href="{{ route('cash_registers.index') }}" class="mobile-btn rounded-md px-3 py-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">💰 Caixa</a>
                <div class="border-t border-gray-600 mt-3 pt-3">
                  <div class="flex items-center px-3 py-2 text-sm text-gray-300">
                    <img src="https://ui-avatars.com/api/?name=Paulinho&background=4f46e5&color=fff&size=64" alt="Avatar" class="w-8 h-8 rounded-full object-cover mr-3" />
                    <span>Paulinho</span>
                  </div>
                  <a href="#" class="mobile-btn block rounded-md px-3 py-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">⚙️ Configurações</a>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="mobile-btn w-full text-left rounded-md px-3 py-3 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">🚪 Sair</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <main class="flex-1 w-full pb-16 md:pb-6">
    <!-- Notificações Flash -->
    @if(session('success'))
        <div x-data="{ show: true }"
             x-show="show"
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="transform opacity-0 translate-y-2"
             x-transition:enter-end="transform opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="transform opacity-100 translate-y-0"
             x-transition:leave-end="transform opacity-0 translate-y-2"
             x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-20 right-4 z-50 max-w-sm w-full">
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 shadow-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                    <div class="ml-3">
                        <button @click="show = false" class="text-green-400 hover:text-green-600 focus:outline-none">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }"
             x-show="show"
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="transform opacity-0 translate-y-2"
             x-transition:enter-end="transform opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="transform opacity-100 translate-y-0"
             x-transition:leave-end="transform opacity-0 translate-y-2"
             x-init="setTimeout(() => show = false, 7000)"
             class="fixed top-20 right-4 z-50 max-w-sm w-full">
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 shadow-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                    <div class="ml-3">
                        <button @click="show = false" class="text-red-400 hover:text-red-600 focus:outline-none">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div x-data="{ show: true }"
             x-show="show"
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="transform opacity-0 translate-y-2"
             x-transition:enter-end="transform opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="transform opacity-100 translate-y-0"
             x-transition:leave-end="transform opacity-0 translate-y-2"
             x-init="setTimeout(() => show = false, 8000)"
             class="fixed top-20 right-4 z-50 max-w-sm w-full">
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 shadow-lg">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <h3 class="text-sm font-medium text-red-800">Erros de validação:</h3>
                        <ul class="mt-1 text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="ml-3">
                        <button @click="show = false" class="text-red-400 hover:text-red-600 focus:outline-none">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="px-2 sm:px-4 lg:px-8 py-4 md:py-6">
      @yield('content')
    </div>
    {{-- Paginação global condicional --}}
    @isset($paginator)
        <div class="mt-6 px-4">
            {{ $paginator->links('pagination::tailwind') }}
        </div>
    @endisset
  </main>
</div>
</body>
</html>
