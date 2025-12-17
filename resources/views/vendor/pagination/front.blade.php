@if ($paginator->hasPages())
    <div class="flex items-center justify-center pb-10">
        <nav class="flex items-center gap-x-2" aria-label="Pagination">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                    <span class="btn btn-soft disabled" aria-hidden="true">
                        <span class="icon-[tabler--chevron-left] size-5 rtl:rotate-180" aria-hidden="true"></span>
                        <span class="hidden sm:inline ml-2">Previous</span>
                    </span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-soft"
                    aria-label="{{ __('pagination.previous') }}">
                    <span class="icon-[tabler--chevron-left] size-5 rtl:rotate-180" aria-hidden="true"></span>
                    <span class="hidden sm:inline ml-2">Previous</span>
                </a>
            @endif

            {{-- Page buttons --}}
            <div class="flex items-center gap-x-2">
                @foreach ($elements as $element)
                    {{-- "Three Dots" separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span class="btn btn-soft px-4 py-2">{{ $element }}</span>
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page">
                                    <span class="btn btn-soft btn-square text-bg-soft-primary bg-soft-primary"
                                        aria-hidden="true">
                                        {{ $page }}
                                    </span>
                                </span>
                            @else
                                <a href="{{ $url }}" class="btn btn-soft btn-square"
                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-soft"
                    aria-label="{{ __('pagination.next') }}">
                    <span class="hidden sm:inline mr-2">Next</span>
                    <span class="icon-[tabler--chevron-right] size-5 rtl:rotate-180" aria-hidden="true"></span>
                </a>
            @else
                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                    <span class="btn btn-soft disabled" aria-hidden="true">
                        <span class="hidden sm:inline mr-2">Next</span>
                        <span class="icon-[tabler--chevron-right] size-5 rtl:rotate-180" aria-hidden="true"></span>
                    </span>
                </span>
            @endif
        </nav>
    </div>
@endif
