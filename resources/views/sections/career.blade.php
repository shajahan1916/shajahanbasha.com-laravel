<section class="swiper-slide slide" id="career" data-hash="career">
    <div class="slide-in">
        <div class="s-head" data-anim>
            <span class="eyebrow">Career</span>
            <h2>{{ ucfirst($careerCount) }} roles, <span class="grad-text">one direction</span></h2>
            <p>Drag the deck, use the arrows, or press &larr; &rarr;. Newest first.</p>
        </div>

        <div class="cover-stage" id="coverStage" tabindex="0" aria-label="Career history carousel" data-anim>
            @foreach($career as $i => $job)
                <article class="cover-card">
                    <span class="rule"></span>
                    <span class="span">{{ $job['span'] }}</span>
                    <h3>{{ $job['role'] }}</h3>
                    <span class="org">{{ $job['company'] }}</span>
                    <p>{{ $job['summary'] }}</p>
                    <div class="tags">
                        @foreach($job['tags'] as $tag)
                            <span>{{ $tag }}</span>
                        @endforeach
                    </div>
                    <span class="stamp">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                </article>
            @endforeach
        </div>

        <div class="cover-nav" data-anim>
            <button type="button" id="coverPrev" aria-label="Previous role"><i class="bi bi-arrow-left"></i></button>
            <div class="cover-dots" id="coverDots"></div>
            <span class="cover-count" id="coverCount">01 / {{ str_pad(count($career), 2, '0', STR_PAD_LEFT) }}</span>
            <button type="button" id="coverNext" aria-label="Next role"><i class="bi bi-arrow-right"></i></button>
        </div>
    </div>
</section>
