<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <a href="{{ route('account.orders.index') }}"
        class="border-base-content/20 rounded-box flex items-center justify-between gap-3.5 border p-4">
        <div class="avatar avatar-placeholder">
            <div class="border-base-content/20 rounded-box size-12 border">
                <span class="icon-[tabler--shopping-bag] size-7"></span>
            </div>
        </div>
        <div class="grow">
            <h3 class="text-base-content text-lg font-medium">Your Orders</h3>
            <p class="text-base-content/80">Buy things again</p>
        </div>
    </a>

    <a href="{{ route('account.addresses.index') }}"
        class="border-base-content/20 rounded-box flex items-center justify-between gap-3.5 border p-4">
        <div class="avatar avatar-placeholder">
            <div class="border-base-content/20 rounded-box size-12 border">
                <span class="icon-[tabler--map-pin] size-7"></span>
            </div>
        </div>
        <div class="grow">
            <h3 class="text-base-content text-lg font-medium">Your Addresses</h3>
            <p class="text-base-content/80">Edit Address to Order</p>
        </div>
    </a>

    <a href="{{ route('account.wishlist') }}"
        class="border-base-content/20 rounded-box flex items-center justify-between gap-3.5 border p-4">
        <div class="avatar avatar-placeholder">
            <div class="border-base-content/20 rounded-box size-12 border">
                <span class="icon-[tabler--heart] size-7"></span>
            </div>
        </div>
        <div class="grow">
            <h3 class="text-base-content text-lg font-medium">Your Wishlist</h3>
            <p class="text-base-content/80">Let's get wishlist to doorstep</p>
        </div>
    </a>

    <a href="{{ route('profile.edit') }}"
        class="border-base-content/20 rounded-box flex items-center justify-between gap-3.5 border p-4">
        <div class="avatar avatar-placeholder">
            <div class="border-base-content/20 rounded-box size-12 border">
                <span class="icon-[tabler--user-cog] size-7"></span>
            </div>
        </div>
        <div class="grow">
            <h3 class="text-base-content text-lg font-medium">Your Profile</h3>
            <p class="text-base-content/80">Edit login name and mobile number</p>
        </div>
    </a>
</div>
