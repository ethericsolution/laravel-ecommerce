@if (setting('general.is_captcha'))
    <div class="cf-turnstile" data-sitekey="{{ setting('general.captcha_site_key') }}" data-theme="light"></div>

    <!-- Display error -->
    @error('cf-turnstile-response')
        <p class="helper-text">{{ $message }}</p>
    @enderror
@endif
