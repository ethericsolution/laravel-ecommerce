<form {{ $attributes->merge(['method' => 'POST', 'class' => 'inline']) }}
    onsubmit="return confirm('Are you sure want to delete?')">
    @csrf
    @method('DELETE')

    <button class="btn btn-circle btn-text btn-sm" aria-label="Delete Action">
        <span class="icon-[tabler--trash] size-5"></span>
    </button>
</form>
