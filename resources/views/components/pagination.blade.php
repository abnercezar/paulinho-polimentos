@props(['paginator'])
@if ($paginator instanceof \Illuminate\Pagination\LengthAwarePaginator || $paginator instanceof \Illuminate\Pagination\Paginator)
    @if ($paginator->hasPages())
        <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
            <div class="flex flex-1 justify-between sm:hidden">
                <a href="{{ $paginator->previousPageUrl() ?? '#' }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 @if(!$paginator->onFirstPage()) cursor-pointer @else cursor-not-allowed opacity-50 @endif">Anterior</a>
                <a href="{{ $paginator->nextPageUrl() ?? '#' }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 @if($paginator->hasMorePages()) cursor-pointer @else cursor-not-allowed opacity-50 @endif">Próximo</a>
            </div>
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Exibindo
                        <span class="font-medium">{{ ($paginator->currentPage() - 1) * $paginator->perPage() + 1 }}</span>
                        até
                        <span class="font-medium">{{ min($paginator->currentPage() * $paginator->perPage(), $paginator->total()) }}</span>
                        de
                        <span class="font-medium">{{ $paginator->total() }}</span>
                        resultados
                    </p>
                </div>
                <div>
                    <nav aria-label="Pagination" class="isolate inline-flex -space-x-px rounded-md shadow-xs">
                        {{-- Previous --}}
                        <a href="{{ $paginator->previousPageUrl() ?? '#' }}" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0 @if(!$paginator->onFirstPage()) cursor-pointer @else cursor-not-allowed opacity-50 @endif">
                            <span class="sr-only">Anterior</span>
                            <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-5">
                                <path d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                        </a>
                        {{-- Pages --}}
                        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <a href="#" aria-current="page" class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $page }}</a>
                            @else
                                <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0">{{ $page }}</a>
                            @endif
                        @endforeach
                        {{-- Next --}}
                        <a href="{{ $paginator->nextPageUrl() ?? '#' }}" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-gray-300 ring-inset hover:bg-gray-50 focus:z-20 focus:outline-offset-0 @if($paginator->hasMorePages()) cursor-pointer @else cursor-not-allowed opacity-50 @endif">
                            <span class="sr-only">Próximo</span>
                            <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-5">
                                <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    @endif
@endif
