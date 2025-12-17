<div>
    <div class="breadcrumbs">
        <ul>
            @foreach ($links as $link)
                @if (!$loop->first)
                    <li class="breadcrumbs-separator rtl:rotate-180"><span class="icon-[tabler--chevron-right]"></span>
                    </li>
                @endif
                <li>
                    @if (!$loop->last)
                        <a href="{{ $link['url'] }}">{{ $link['text'] }}</a>
                    @else
                        <span aria-current="page">{{ $link['text'] }}</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <div class="mt-2 md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h1 class="text-base-content text-3xl font-semibold">{{ $title }}</h1>
        </div>
        <div class="mt-4 flex shrink-0 md:ml-4 md:mt-0">
            @isset($addNewAction)
                <a href="{{ $addNewAction }}" class="btn btn-primary gap-1">
                    <span class="icon-[tabler--circle-plus] size-5"></span>
                    <span>Add New</span>
                </a>
            @endisset

            @isset($goBackAction)
                <a href="{{ $goBackAction }}" class="btn btn-primary gap-1">
                    <span class="icon-[tabler--arrow-left] size-5"></span>
                    <span>Go Back</span>
                </a>
            @endisset
        </div>
    </div>
</div>
