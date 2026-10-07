<section class="swiper-slide slide" id="certs" data-hash="certs">
    <div class="slide-in">
        <div class="s-head" data-anim>
            <span class="eyebrow">Credentials</span>
            <h2>Certified where it <span class="grad-text">matters</span></h2>
            <p>{{ ucfirst($certCount) }} certifications behind the architecture calls. Flip a card for the detail.</p>
        </div>

        <div class="row g-3">
            @foreach($certifications as $cert)
                <div class="col-sm-6 col-lg-3" data-anim>
                    <div class="flip" tabindex="0">
                        <div class="flip-in">
                            <div class="flip-face">
                                <div class="badge-ico"><i class="bi {{ $cert['icon'] }}"></i></div>
                                <h4>{{ $cert['title'] }}</h4>
                                <small>{{ $cert['issuer'] }}</small>
                                <span class="flip-hint">Hover to flip</span>
                            </div>
                            <div class="flip-face flip-back"><p>{{ $cert['detail'] }}</p></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
