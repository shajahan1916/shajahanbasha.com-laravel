<section class="swiper-slide slide" id="about" data-hash="about">
    <div class="slide-in">
        <div class="s-head" data-anim>
            <span class="eyebrow">About</span>
            <h2>{!! $about['heading'] !!}</h2>
        </div>

        <div class="row g-4 align-items-center">
            <div class="col-lg-5" data-anim>
                <div class="photo">
                    <img src="{{ asset($profile['images']['portrait']) }}"
                         alt="{{ $profile['name'] }} in the office" width="900" height="1350" loading="lazy">
                    <div class="photo-tag">
                        <span>{{ $profile['location'] }}</span><span>Est. 2013</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-7" data-anim>
                <div class="glass about-body">
                    <span class="glass-line"></span>
                    @foreach($about['paragraphs'] as $paragraph)
                        <p>{!! $paragraph !!}</p>
                    @endforeach

                    <div class="mini-grid">
                        @foreach($about['points'] as $point)
                            <div class="mini">
                                <i class="bi {{ $point['icon'] }}"></i>
                                <b>{{ $point['title'] }}</b>
                                <span>{{ $point['note'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
