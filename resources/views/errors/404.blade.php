<x-layouts.front>
    <!-- 404 Start -->
    <div class="mx-auto max-w-7xl py-[150px]">
        <div class="text-center">
            <h2 class="text-9xl leading-tight font-bold text-primary-500">404</h2>
            <p class="text-3xl leading-tight font-bold text-primary-500 pb-5 capitalize">
                Oops! Page not
                found</p>
            <p class="text-lg leading-tight font-normal text-gray-500 ">The page
                you are looking for doesn't exist or has been removed.</p>
            <a href="{{ route('home') }}"
                class="bg-primary-600 px-4 py-2.5 rounded-md text-white leading-tight inline-block items-center justify-center mt-6 transition-all duration-300 ease-in-out hover:bg-primary-500">Back
                to Home</a>
        </div>
    </div>
    <!-- 404 end -->
</x-layouts.front>
