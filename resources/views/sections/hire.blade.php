<section class="swiper-slide slide" id="hire" data-hash="hire">
    <div class="slide-in">
        <div class="s-head" data-anim>
            <span class="eyebrow">Why hire me</span>
            <h2>Two ways to <span class="grad-text">work together</span></h2>
        </div>

        <div class="row g-4">
            @foreach($hire as $column)
                <div class="col-lg-6" data-anim>
                    <div class="glass hire-col">
                        <span class="glass-line"></span>
                        <h3>{{ $column['title'] }}</h3>
                        <span class="sub">{{ $column['audience'] }}</span>

                        @foreach($column['items'] as $item)
                            <div class="hire-item">
                                <span class="hi-ico"><i class="bi {{ $item['icon'] }}"></i></span>
                                <div>
                                    <b>{{ $item['title'] }}</b>
                                    <span>{{ $item['note'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
