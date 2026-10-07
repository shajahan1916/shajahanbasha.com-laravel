<aside class="rail">
    <div class="shield">
        <img src="{{ asset($profile['images']['avatar']) }}" alt="{{ $profile['name'] }}">
    </div>
    <div class="rail-name">{{ $profile['short'] }}</div>
    <div class="rail-role">Technical Lead</div>

    <ul class="rail-menu" id="railMenu">
        @foreach($menu as $i => $item)
            <li>
                <button type="button" data-go="{{ $i }}" @class(['on' => $i === 0])>
                    <i class="bi {{ $item['icon'] }}"></i> {{ $item['label'] }}
                </button>
            </li>
        @endforeach
    </ul>

    <div class="rail-foot">
        <div class="rail-social">
            @foreach($social as $link)
                <a href="{{ $link['url'] }}" aria-label="{{ $link['label'] }}"
                   @if(! str_starts_with($link['url'], 'mailto:')) target="_blank" rel="noopener" @endif>
                    <i class="bi {{ $link['icon'] }}"></i>
                </a>
            @endforeach
            <a href="{{ route('cv') }}" aria-label="Download CV"><i class="bi bi-file-earmark-arrow-down"></i></a>
        </div>
        @if($profile['available'])
            <span class="rail-avail"><i></i> Open to work</span>
        @endif
    </div>
</aside>
