<!-- resources/views/components/breadcrumb.blade.php -->

<div class="bg-gray-100 pt-3 pb-2 mx-auto">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="breadcrumbs">
            <ul>
                @foreach ($links as $link)
                    @if ($loop->last)
                        <li aria-current="page">{{ $link['text'] }}</li>
                    @else
                        <li>
                            <a href="{{ $link['url'] }}">{{ $link['text'] }}</a>
                        </li>
                        <li class="breadcrumbs-separator rtl:-rotate-[40deg]">/</li>
                    @endif
                @endforeach
            </ul>
        </div>

        {{-- <h1 class="text-2xl lg:text-4xl font-semibold text-base-content">{{ $title }}</h1> --}}
    </div>
</div>
