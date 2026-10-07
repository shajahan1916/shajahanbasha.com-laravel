<section class="swiper-slide slide" id="contact" data-hash="contact">
    <div class="slide-in">
        <div class="s-head" data-anim>
            <span class="eyebrow">Contact</span>
            <h2>Tell me what you're <span class="grad-text">building</span></h2>
        </div>

        <div class="row g-4">
            <div class="col-lg-5" data-anim>
                <div class="band mb-3">
                    <img src="{{ asset($profile['images']['office']) }}" alt="{{ $profile['name'] }} at work" loading="lazy">
                    <div class="band-in">
                        <h4>Available for roles and freelance</h4>
                        <small>Hyderabad · Remote worldwide</small>
                    </div>
                </div>

                <div class="glass p-3 p-lg-4">
                    <span class="glass-line"></span>

                    <div class="info-row">
                        <span class="ir-ico"><i class="bi bi-envelope"></i></span>
                        <div>
                            <b>Email</b>
                            <a href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a>
                        </div>
                    </div>

                    <div class="info-row">
                        <span class="ir-ico"><i class="bi bi-telephone"></i></span>
                        <div>
                            <b>Phone</b>
                            @foreach($contact['phones'] as $label => $number)
                                <a href="tel:{{ $number }}">{{ $label }}</a>@if(! $loop->last) · @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="info-row">
                        <span class="ir-ico"><i class="bi bi-geo-alt"></i></span>
                        <div><b>Address</b><p>{{ $contact['address'] }}</p></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7" data-anim>
                <div class="glass form-card">
                    <span class="glass-line"></span>

                    <form id="contactForm" method="POST" action="{{ route('contact.store') }}" novalidate>
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="field">
                                    <label for="cName">Your name</label>
                                    <input id="cName" name="name" type="text" value="{{ old('name') }}"
                                           placeholder="Jane Doe" autocomplete="name" required>
                                    @error('name') <em class="field-error">{{ $message }}</em> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field">
                                    <label for="cEmail">Email</label>
                                    <input id="cEmail" name="email" type="email" value="{{ old('email') }}"
                                           placeholder="jane@company.com" autocomplete="email" required>
                                    @error('email') <em class="field-error">{{ $message }}</em> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label for="cMsg">Message</label>
                            <textarea id="cMsg" name="message" rows="3"
                                      placeholder="A few lines about the role or the project…" required>{{ old('message') }}</textarea>
                            @error('message') <em class="field-error">{{ $message }}</em> @enderror
                        </div>

                        {{-- Honeypot: real people never fill this in. --}}
                        <div class="hp" aria-hidden="true">
                            <label for="cWebsite">Website</label>
                            <input id="cWebsite" name="website" type="text" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="intent">
                            @foreach($contact['intents'] as $i => $intent)
                                <input type="radio" name="intent" id="i{{ $i }}" value="{{ $intent }}"
                                       @checked(old('intent', $contact['intents'][count($contact['intents']) - 1]) === $intent)>
                                <label for="i{{ $i }}">{{ $intent }}</label>
                            @endforeach
                        </div>

                        <button type="submit" class="btn-solid"><i class="bi bi-send"></i> Send message</button>

                        <p class="form-note">I usually reply within a working day.</p>

                        <div id="formStatus" role="status"
                             class="{{ session('status') ? 'ok' : '' }}"
                             style="{{ session('status') ? 'display:block' : '' }}">{{ session('status') }}</div>
                    </form>
                </div>
            </div>
        </div>

        <p class="credit" data-anim>
            &copy; {{ date('Y') }} {{ $profile['name'] }} · {{ $profile['title'] }} · {{ $profile['location'] }}
        </p>
    </div>
</section>
