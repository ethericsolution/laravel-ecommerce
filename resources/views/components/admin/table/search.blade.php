{{-- Search Form --}}
<form method="GET" class="mb-4 flex justify-end">
    <div class="join max-w-sm">
        <input class="input join-item" type="search" name="query" value="{{ request('query') }}" placeholder="Search" />
        <button class="btn btn-primary join-item">Search</button>
    </div>
</form>
