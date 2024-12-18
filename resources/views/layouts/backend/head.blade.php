
    @include('layouts.backend.meta')

    @if ($webConfig['siteFavicon'] !== '')
        <link rel="shortcut icon" href="{{ asset('storage/' . $webConfig['siteFavicon']) }}" type="image/x-icon">
    @endif

    <title>
        @if (!empty($title))
            {{ $title . ' - ' . $webConfig['siteName'] }}
        @else
            {{ $webConfig['siteName'] }}
        @endif
    </title>


    @include('layouts.backend.styles')

    @stack('styles')

    <script type="application/ld+json">
    {
        "@context": "https:\/\/schema.org",
        "@type": "{{ $webConfig['siteName'] }}",
        "name": "{{ $webConfig['siteName'] }}",
        "email": "{{ $webConfig['adminEmail'] }}",
        "url": "{{ $webConfig['siteUrl'] }}",
        "contactPoint": {
            "@type": "ContactPoint",
        "telephone": "+923-123-123-123",
        "areaServed": "Worldwide",
        "contactType": "customer support"
        }
    }
    </script>
