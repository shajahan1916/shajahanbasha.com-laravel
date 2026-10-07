<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', $profile['name'].' — '.$profile['title'])</title>
<meta name="description" content="{{ $profile['meta'] }}">
<meta name="author" content="{{ $profile['name'] }}">
<meta property="og:title" content="{{ $profile['name'] }} — {{ $profile['title'] }}">
<meta property="og:description" content="{{ $profile['meta'] }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset($profile['images']['hero']) }}">
<link rel="canonical" href="{{ url()->current() }}">
<link rel="icon" href="{{ asset($profile['images']['avatar']) }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css">
<link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ config('portfolio.version', '1') }}">

@stack('head')

<script>(function(w, d) { w.CollectId = "64ef1ef58a3fde15c3eccb86"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.async=true; s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script>
</head>
<body>

@include('partials.preloader')
@include('partials.atmosphere')
@include('partials.rail')
@include('partials.topbar')
@include('partials.dots')

<div class="stage">
    <div class="swiper deck" id="deck">
        <div class="swiper-wrapper">
            @yield('slides')
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js"></script>
<script>
window.Portfolio = {
    roles: @json($roles),
    contactUrl: "{{ route('contact.store') }}",
    csrf: "{{ csrf_token() }}",
    slides: {{ count($menu) }},
    openContact: @json(session('status') !== null || $errors->any())
};
</script>
<script src="{{ asset('js/app.js') }}?v={{ config('portfolio.version', '1') }}"></script>
@stack('scripts')
</body>
</html>
