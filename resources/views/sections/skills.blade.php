<section class="swiper-slide slide" id="skills" data-hash="skills">
    <div class="slide-in text-center">
        <div class="s-head" data-anim style="margin-left:auto;margin-right:auto">
            <span class="eyebrow">Toolkit</span>
            <h2>The stack I <span class="grad-text">actually use</span></h2>
            <p style="margin-inline:auto">
                {{ count($skills) }} technologies I've shipped production work with. Hover the carousel to hold it still.
            </p>
        </div>

        <div class="ring-stage" data-anim>
            <div class="ring" style="--step:{{ round(360 / max(count($skills), 1), 3) }}deg">
                @foreach($skills as $i => $skill)
                    <div class="ring-card" style="--i:{{ $i }}">
                        <i class="bi {{ $skill['icon'] }}"></i>
                        <span>{{ $skill['name'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <p class="ring-note" data-anim>{{ $skillsSummary }}</p>
    </div>
</section>
