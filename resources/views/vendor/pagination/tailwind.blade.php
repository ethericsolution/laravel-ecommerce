@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

        {{-- Page details --}}
        <div class="me-2 block max-w-sm text-sm text-base-content/80 sm:mb-0">
            Showing
            @if ($paginator->firstItem())
                <span
                    class="font-semibold text-base-content/80">{{ $paginator->firstItem() }}-{{ $paginator->lastItem() }}</span>
            @else
                <span class="font-semibold text-base-content/80">{{ $paginator->count() }}</span>
            @endif
            of
            <span class="font-semibold">{{ $paginator->total() }}</span>
            records
        </div>

        {{-- Pagination --}}
        <nav class="flex items-center gap-x-1">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="btn btn-soft max-sm:btn-square cursor-not-allowed opacity-50">
                    <span class="icon-[tabler--chevron-left] size-5 rtl:rotate-180"></span>
                    <span class="hidden sm:inline">Previous</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-soft max-sm:btn-square">
                    <span class="icon-[tabler--chevron-left] size-5 rtl:rotate-180"></span>
                    <span class="hidden sm:inline">Previous</span>
                </a>
            @endif

            {{-- Page numbers --}}
            <div class="flex items-center gap-x-1">
                @foreach ($elements as $element)
                    {{-- Dots --}}
                    @if (is_string($element))
                        <span class="btn btn-soft btn-square cursor-default">{{ $element }}</span>
                    @endif

                    {{-- Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page"
                                    class="btn btn-soft btn-square aria-[current='page']:text-bg-soft-primary font-semibold">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="btn btn-soft btn-square aria-[current='page']:text-bg-soft-primary">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-soft max-sm:btn-square">
                    <span class="hidden sm:inline">Next</span>
                    <span class="icon-[tabler--chevron-right] size-5 rtl:rotate-180"></span>
                </a>
            @else
                <span class="btn btn-soft max-sm:btn-square cursor-not-allowed opacity-50">
                    <span class="hidden sm:inline">Next</span>
                    <span class="icon-[tabler--chevron-right] size-5 rtl:rotate-180"></span>
                </span>
            @endif

        </nav>
    </div>
@endif
