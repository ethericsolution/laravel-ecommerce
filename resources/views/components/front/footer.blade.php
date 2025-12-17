<div class="bg-base-200/60">
    <footer class="footer mx-auto max-w-7xl px-4 py-4 sm:px-6 sm:py-6 lg:px-8 lg:py-8">
        <aside class="gap-6">
            <div class="flex items-center gap-2 text-xl font-bold text-base-content">
                <img src="{{ getLogoURL() }}" alt="{{ setting('general.app_name') }}" class="h-14" loading="lazy" />
            </div>
            <p class="text-base-content text-sm">Trusted OTC products delivered nationwide
                with care
                and convenience. <br>Your one-stop online store for all over-the-counter health essentials.
            </p>
            <div class="flex h-5 gap-4">
                @if (setting('social.facebook'))
                    <a href="{{ setting('social.facebook') }}" target="_blank" class="link"
                        aria-label="Facebook Link">
                        <span class="icon-[tabler--brand-facebook] size-5"></span>
                    </a>
                @endif
                @if (setting('social.instagram'))
                    <a href="{{ setting('social.instagram') }}" target="_blank" class="link"
                        aria-label="Instagram Link">
                        <span class="icon-[tabler--brand-instagram] size-5"></span>
                    </a>
                @endif
                @if (setting('social.twitter'))
                    <a href="{{ setting('social.twitter') }}" target="_blank" class="link" aria-label="X Link">
                        <span class="icon-[tabler--brand-x] size-5"></span>
                    </a>
                @endif
                @if (setting('social.youtube'))
                    <a href="{{ setting('social.youtube') }}" target="_blank" class="link" aria-label="Youtube Link">
                        <span class="icon-[tabler--brand-youtube] size-5"></span>
                    </a>
                @endif
            </div>
        </aside>
        <div class="text-base-content">
            <h6 class="footer-title">Powerhouse Pharmacy</h6>

            <p>4740 W Mockingbird Ln <br>#100B, Dallas, <br>TX
                75209,
                United States</p>
            <a href="tel:+1214-350-2900" class="link link-hover">+1 214-350-2900</a>
        </div>
        <div class="text-base-content">
            <h6 class="footer-title">Texas Health Rx Pharmacy</h6>
            <p>12333 Bear Plaza Ste.<br> #100, Burleson, <br>TX
                76028,
                United States</p>
            <a href="tel:+18177894099" class="link link-hover">+1 817-789-4099</a>
        </div>
        <div class="text-base-content">
            <h6 class="footer-title">Newsletter</h6>
            <p class="text-base-content text-sm">Subscribe to get updates on <br>new products and exclusive offers.
            </p>
            <form action="{{ route('subscribers.store') }}" method="POST">
                @csrf
                <fieldset>
                    <label class="label-text" for="subscribeLetter">Subscribe to newsletter</label>
                    <div class="flex w-full flex-wrap gap-1 sm:flex-nowrap">
                        <input class="input" id="subscribeLetter" name="email" type="email"
                            placeholder="Enter your email" required />
                        <button class="btn btn-primary" type="submit">Subscribe</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </footer>

    <footer class="footer mx-auto max-w-7xl border-base-content/25 border-t px-4 py-4 sm:px-6 sm:py-6 lg:px-8 lg:py-8">
        <div class="flex w-full items-center justify-between">
            <aside class="grid-flow-col items-center">
                <p> &copy; {{ date('Y') }} {{ setting('general.app_name') }}. All rights reserved. Developed by
                    <a class="link link-hover font-medium" href="https://ethericsolution.com/" target="_blank">Etheric
                        Solution</a>
                </p>
            </aside>
            <div class="flex items-center gap-4">
                <span class="text-accent-400 text-sm">We Accept:</span>
                <div class="p-2">
                    <img src="{{ asset('assets/images/payments.png') }}" alt="Payment Methods" class="h-6"
                        loading="lazy" />
                </div>
            </div>
        </div>
    </footer>
</div>
