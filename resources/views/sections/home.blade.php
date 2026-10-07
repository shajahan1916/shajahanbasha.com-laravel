<section class="swiper-slide slide" id="home" data-hash="home">
    <div class="slide-in">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                @if($profile['available'])
                    <span class="kicker" data-anim><i></i> Open to roles &amp; freelance work</span>
                @endif

                <p class="hello" data-anim>Hello, I am</p>

                <h1 class="h-name" data-anim>{{ $profile['first'] }} <em>{{ $profile['last'] }}</em></h1>

                <div class="h-role" data-anim>I am <span id="typed"></span><span class="cursor">|</span></div>

                <p class="h-lede" data-anim>{{ $profile['lede'] }}</p>

                <div class="d-flex flex-wrap gap-3 align-items-center" data-anim>
                    <a href="{{ route('cv') }}" class="btn-solid"><i class="bi bi-download"></i> Download CV</a>
                    <a href="#contact" class="btn-ghost" data-go="{{ $slideIndex['contact'] }}"><i class="bi bi-envelope"></i> Contact me</a>
                    <a href="#career" class="link-work" data-go="{{ $slideIndex['career'] }}">See my work <i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="stats" data-anim>
                    @foreach($stats as $stat)
                        <div>
                            <b data-count="{{ $stat['value'] }}" data-suffix="{{ $stat['suffix'] }}">0</b>
                            <span>{{ $stat['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-5">
                <div class="slab-wrap" data-anim>
                    <div class="slab" id="slab">
                        <div class="halo"></div>
                        <div class="slab-inner">
                            <img src="{{ asset($profile['images']['hero']) }}"
                                 alt="Portrait of {{ $profile['name'] }}" width="1000" height="1000">
                        </div>
                        @foreach($chips as $chip)
                            <div class="chip {{ $chip['class'] }}"><i class="bi {{ $chip['icon'] }}"></i> {{ $chip['text'] }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
