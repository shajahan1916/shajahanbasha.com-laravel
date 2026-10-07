<section class="swiper-slide slide" id="deliver" data-hash="deliver">
    <div class="slide-in">
        <div class="s-head" data-anim>
            <span class="eyebrow">What I deliver</span>
            <h2>{{ ucfirst($deliverCount) }} things you can <span class="grad-text">hand me</span></h2>
        </div>

        <div class="row g-3">
            @foreach($deliver as $i => $item)
                <div class="col-md-6 col-lg-4" data-anim>
                    <div class="card-6 tilt">
                        <span class="idx">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <div class="ico"><i class="bi {{ $item['icon'] }}"></i></div>
                        <h4>{{ $item['title'] }}</h4>
                        <p>{{ $item['note'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
