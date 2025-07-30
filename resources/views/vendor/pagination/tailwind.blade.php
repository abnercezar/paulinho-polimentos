{{-- Custom pagination view with modern SVG icons --}}
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-4">
        <ul class="flex flex-wrap items-center gap-1 bg-gray-50 p-2 rounded-xl shadow border border-gray-200">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-2 py-1 text-gray-400 bg-gray-50 border border-gray-300 rounded-l-md transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 20 20" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.75 15.25L8.25 10.75L12.75 6.25" /></svg>
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-2 py-1 text-gray-700 bg-gray-50 border border-gray-300 hover:bg-blue-100 focus:ring-2 focus:ring-blue-400 rounded-l-md transition-all duration-200" aria-label="Previous">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 20 20" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.75 15.25L8.25 10.75L12.75 6.25" /></svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="px-2 py-1 text-gray-700 bg-gray-50 border border-gray-300">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="px-2 py-1 text-white bg-blue-600 border border-blue-600 font-bold shadow-md scale-110">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="px-2 py-1 text-gray-700 bg-gray-50 border border-gray-300 hover:bg-blue-100 focus:ring-2 focus:ring-blue-400 transition-all duration-200">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-2 py-1 text-gray-700 bg-gray-50 border border-gray-300 hover:bg-blue-100 focus:ring-2 focus:ring-blue-400 rounded-r-md transition-all duration-200" aria-label="Next">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 20 20" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.25 6.25L11.75 10.75L7.25 15.25" /></svg>
                    </a>
                </li>
            @else
                <li>
                    <span class="px-2 py-1 text-gray-400 bg-gray-50 border border-gray-300 rounded-r-md transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 20 20" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.25 6.25L11.75 10.75L7.25 15.25" /></svg>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
