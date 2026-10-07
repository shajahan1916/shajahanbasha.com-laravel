<header class="topbar">
    <div class="tb-brand">
        <img src="{{ asset($profile['images']['avatar']) }}" alt=""><b>{{ $profile['short'] }}</b>
    </div>
    <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false"><i class="bi bi-list"></i></button>
</header>

<div id="sheet" aria-hidden="true">
    <button class="sh-close" id="shClose" aria-label="Close menu"><i class="bi bi-x-lg"></i></button>
    @foreach($menu as $i => $item)
        <button type="button" data-go="{{ $i }}">{{ $item['label'] }}</button>
    @endforeach
</div>
