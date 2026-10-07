(function(){
  "use strict";
  var REDUCED = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  var HAS_GSAP = typeof window.gsap !== "undefined";
  var HAS_SWIPER = typeof window.Swiper !== "undefined";
  var TOUCH = window.matchMedia("(pointer: coarse)").matches;
  var DESKTOP = window.matchMedia("(min-width: 992px)");
  var slides = [].slice.call(document.querySelectorAll(".slide"));
  var NAMES = ["Home","About","Skills","Deliver","Certs","Hire Me","Career","Contact"];
  var swiper = null, current = 0;

  /* ---------- PRELOADER ---------- */
  (function(){
    var host = document.getElementById("plName"), pre = document.getElementById("preloader"), bar = document.getElementById("plBar");
    "SHAJAHAN".split("").forEach(function(ch){
      var s = document.createElement("span"); s.textContent = ch; host.appendChild(s);
    });
    function finish(){
      document.body.classList.remove("is-locked");
      if(HAS_GSAP && !REDUCED){
        gsap.to(pre,{duration:.85,rotateX:-12,yPercent:-102,opacity:0,ease:"power3.inOut",
          onComplete:function(){ pre.remove(); boot(); }});
      } else { pre.remove(); boot(); }
    }
    document.body.classList.add("is-locked");
    if(HAS_GSAP && !REDUCED){
      gsap.timeline()
        .to("#plName span",{yPercent:0,duration:.65,stagger:.04,ease:"power3.out"})
        .to(bar,{width:"100%",duration:.9,ease:"power2.inOut"},"-=.35")
        .add(finish,"+=.1");
    } else {
      bar.style.width = "100%";
      [].slice.call(host.children).forEach(function(s){ s.style.transform = "none"; });
      setTimeout(finish, 300);
    }
  })();

  /* ---------- 3D CONTENT ENTRANCE ---------- */
  function items(slide){ return slide.querySelectorAll("[data-anim]"); }

  function animateIn(slide, dir){
    var el = items(slide);
    if(!el.length) return;
    if(!HAS_GSAP || REDUCED){
      [].slice.call(el).forEach(function(n){ n.style.opacity = 1; n.style.transform = "none"; });
      return;
    }
    gsap.killTweensOf(el);
    gsap.fromTo(el,
      {opacity:0, y:(dir < 0 ? -70 : 70), z:-300, rotateX:(dir < 0 ? -16 : 16), transformOrigin:"50% 50%"},
      {opacity:1, y:0, z:0, rotateX:0, duration:.95, stagger:.075, ease:"power3.out", delay:.12, overwrite:"auto"}
    );
  }
  function animateOut(slide, dir){
    if(!HAS_GSAP || REDUCED) return;
    var el = items(slide);
    if(!el.length) return;
    gsap.to(el,{opacity:0, y:(dir < 0 ? 50 : -50), z:-220, rotateX:(dir < 0 ? 12 : -12),
      duration:.45, stagger:.03, ease:"power2.in", overwrite:"auto"});
  }

  /* ---------- NAV STATE ---------- */
  var dotsHost = document.getElementById("dots");
  NAMES.forEach(function(name, i){
    var b = document.createElement("button");
    b.className = "dot"; b.dataset.go = i;
    b.setAttribute("aria-label", "Go to " + name);
    b.innerHTML = '<span>' + name + '</span><i></i>';
    dotsHost.appendChild(b);
  });

  function setActive(i){
    current = i;
    document.querySelectorAll("#railMenu button").forEach(function(b, n){ b.classList.toggle("on", n === i); });
    document.querySelectorAll(".dots .dot").forEach(function(b, n){ b.classList.toggle("on", n === i); });
    document.getElementById("cNow").textContent = String(i+1).padStart(2, "0");
    document.querySelector(".hint").style.opacity = i === 0 ? 1 : 0;
  }

  function goTo(i){
    i = Math.max(0, Math.min(slides.length - 1, i));
    if(swiper){ swiper.slideTo(i); return; }
    slides[i].scrollIntoView({behavior: REDUCED ? "auto" : "smooth", block: "start"});
    setActive(i);
  }
  document.addEventListener("click", function(e){
    var t = e.target.closest("[data-go]");
    if(!t) return;
    e.preventDefault();
    closeSheet();
    goTo(+t.dataset.go);
  });

  /* ---------- MOBILE SHEET ---------- */
  var sheet = document.getElementById("sheet"), burger = document.getElementById("burger");
  function openSheet(){ sheet.classList.add("open"); sheet.setAttribute("aria-hidden","false"); burger.setAttribute("aria-expanded","true"); }
  function closeSheet(){ sheet.classList.remove("open"); sheet.setAttribute("aria-hidden","true"); burger.setAttribute("aria-expanded","false"); }
  burger.addEventListener("click", openSheet);
  document.getElementById("shClose").addEventListener("click", closeSheet);
  document.addEventListener("keydown", function(e){ if(e.key === "Escape") closeSheet(); });

  /* ---------- THE SLIDER (desktop) / SCROLL REVEALS (mobile) ---------- */
  var revealTriggers = [];

  function buildSlider(){
    if(swiper || !HAS_SWIPER) return;
    document.documentElement.classList.add("slider-on");
    killReveals();
    swiper = new Swiper("#deck", {
      direction:"vertical",
      slidesPerView:1,
      speed: REDUCED ? 0 : 950,
      resistanceRatio:.6,
      touchStartPreventDefault:false,
      mousewheel:{forceToAxis:true, thresholdDelta:6, thresholdTime:420},
      keyboard:{enabled:true},
      hashNavigation:{replaceState:true},
      a11y:{enabled:true},
      on:{
        init:function(sw){ setActive(sw.activeIndex); animateIn(sw.slides[sw.activeIndex], 1); },
        slideChangeTransitionStart:function(sw){
          var dir = sw.activeIndex >= sw.previousIndex ? 1 : -1;
          if(sw.slides[sw.previousIndex] && sw.previousIndex !== sw.activeIndex) animateOut(sw.slides[sw.previousIndex], dir);
          setActive(sw.activeIndex);
          animateIn(sw.slides[sw.activeIndex], dir);
        }
      }
    });
  }

  function killSlider(){
    if(!swiper) return;
    swiper.destroy(true, true);
    swiper = null;
    document.documentElement.classList.remove("slider-on");
    slides.forEach(function(s){
      [].slice.call(items(s)).forEach(function(n){ if(HAS_GSAP) gsap.set(n, {clearProps:"all"}); });
    });
  }

  function buildReveals(){
    if(!HAS_GSAP || typeof ScrollTrigger === "undefined" || REDUCED) {
      slides.forEach(function(s){ animateIn(s, 1); });
      return;
    }
    gsap.registerPlugin(ScrollTrigger);
    slides.forEach(function(s, i){
      var el = items(s);
      if(!el.length) return;
      revealTriggers.push(gsap.fromTo(el,
        {opacity:0, y:60, z:-280, rotateX:14},
        {opacity:1, y:0, z:0, rotateX:0, duration:.85, stagger:.08, ease:"power3.out",
         scrollTrigger:{trigger:s, start: i === 0 ? "top bottom" : "top 78%", once:true}}
      ).scrollTrigger);
    });
    var io = new IntersectionObserver(function(entries){
      entries.forEach(function(e){ if(e.isIntersecting) setActive(slides.indexOf(e.target)); });
    },{rootMargin:"-45% 0px -50% 0px"});
    slides.forEach(function(s){ io.observe(s); });
    revealTriggers.push(io);
  }
  function killReveals(){
    revealTriggers.forEach(function(t){ if(t && t.kill) t.kill(); if(t && t.disconnect) t.disconnect(); });
    revealTriggers = [];
  }

  function setMode(){
    if(DESKTOP.matches && HAS_SWIPER){ buildSlider(); }
    else { killSlider(); killReveals(); buildReveals(); }
  }

  function boot(){
    setMode();
    if(window.Portfolio && window.Portfolio.openContact){
      goTo(slides.length - 1);
    }
    if(DESKTOP.addEventListener) DESKTOP.addEventListener("change", setMode);
    typeRoles();
    countUp();
  }

  /* ---------- TYPED ROLE ---------- */
  function typeRoles(){
    var host = document.getElementById("typed");
    if(!host) return;
    var words = (window.Portfolio && window.Portfolio.roles) || ["Full-Stack Technical Lead"];
    if(!words.length) return;
    if(REDUCED){ host.textContent = words[0]; return; }
    var w = 0, c = 0, del = false;
    (function tick(){
      var word = words[w];
      host.textContent = word.slice(0, c);
      if(!del && c < word.length){ c++; setTimeout(tick, 62); }
      else if(!del){ del = true; setTimeout(tick, 1700); }
      else if(c > 0){ c--; setTimeout(tick, 28); }
      else { del = false; w = (w+1) % words.length; setTimeout(tick, 220); }
    })();
  }

  /* ---------- COUNTERS ---------- */
  function countUp(){
    document.querySelectorAll("[data-count]").forEach(function(el){
      var target = +el.dataset.count, sfx = el.dataset.suffix || "", start = null, dur = 1400;
      function step(t){
        if(!start) start = t;
        var p = Math.min((t-start)/dur, 1);
        el.textContent = Math.floor(p*target) + (p === 1 ? sfx : "");
        if(p < 1) requestAnimationFrame(step);
      }
      requestAnimationFrame(step);
    });
  }

  /* ---------- HERO SLAB TILT ---------- */
  var slab = document.getElementById("slab");
  if(slab && !TOUCH && !REDUCED){
    var wrap = slab.parentElement;
    wrap.addEventListener("mousemove", function(e){
      var r = wrap.getBoundingClientRect();
      var px = (e.clientX - r.left)/r.width - .5, py = (e.clientY - r.top)/r.height - .5;
      slab.style.transform = "rotateY(" + (px*17) + "deg) rotateX(" + (-py*17) + "deg) translateZ(12px)";
    });
    wrap.addEventListener("mouseleave", function(){ slab.style.transform = ""; });
  }
  if(window.VanillaTilt && !TOUCH && !REDUCED && DESKTOP.matches){
    VanillaTilt.init(document.querySelectorAll(".tilt"), {max:9, speed:500, glare:true, "max-glare":.16, scale:1.02, perspective:900});
  }

  /* ---------- CAREER COVERFLOW ---------- */
  (function(){
    var stage = document.getElementById("coverStage");
    if(!stage) return;
    var cards = [].slice.call(stage.querySelectorAll(".cover-card"));
    var dots = document.getElementById("coverDots"), count = document.getElementById("coverCount");
    var idx = 0, n = cards.length, half = Math.floor(n/2);

    cards.forEach(function(_, i){
      var d = document.createElement("i");
      d.setAttribute("role","button"); d.setAttribute("tabindex","0");
      d.setAttribute("aria-label","Go to role " + (i+1));
      d.addEventListener("click", function(){ go(i); });
      d.addEventListener("keydown", function(e){ if(e.key === "Enter" || e.key === " "){ e.preventDefault(); go(i); }});
      dots.appendChild(d);
    });

    function layout(){
      cards.forEach(function(c, i){
        var o = ((i - idx) % n + n + half) % n - half, a = Math.abs(o);
        c.style.transform = "translateX(" + (o*54) + "%) translateZ(" + (-a*210) + "px) rotateY(" + (o*-34) + "deg) scale(" + (1 - a*.07) + ")";
        c.style.opacity = a > 2 ? 0 : (a === 0 ? 1 : (a === 1 ? .45 : .16));
        c.style.zIndex = String(50 - a);
        c.style.filter = a === 0 ? "none" : "blur(" + Math.min(a*2.6, 6) + "px)";
        c.style.pointerEvents = a > 2 ? "none" : "auto";
        c.classList.toggle("is-active", a === 0);
        c.setAttribute("aria-hidden", String(a !== 0));
      });
      [].slice.call(dots.children).forEach(function(d, i){ d.classList.toggle("on", i === idx); });
      count.textContent = String(idx+1).padStart(2,"0") + " / " + String(n).padStart(2,"0");
    }
    function go(i){ idx = ((i % n) + n) % n; layout(); }

    document.getElementById("coverPrev").addEventListener("click", function(){ go(idx-1); });
    document.getElementById("coverNext").addEventListener("click", function(){ go(idx+1); });
    cards.forEach(function(c, i){ c.addEventListener("click", function(){ if(i !== idx) go(i); }); });
    stage.addEventListener("keydown", function(e){
      if(e.key === "ArrowLeft"){ e.preventDefault(); e.stopPropagation(); go(idx-1); }
      if(e.key === "ArrowRight"){ e.preventDefault(); e.stopPropagation(); go(idx+1); }
    });

    var down = false, sx = 0;
    stage.addEventListener("mousedown", function(e){ down = true; sx = e.clientX; });
    window.addEventListener("mouseup", function(e){
      if(!down) return; down = false;
      var d = e.clientX - sx;
      if(Math.abs(d) > 45) go(idx + (d < 0 ? 1 : -1));
    });
    stage.addEventListener("touchstart", function(e){ down = true; sx = e.touches[0].clientX; }, {passive:true});
    stage.addEventListener("touchend", function(e){
      if(!down) return; down = false;
      var d = e.changedTouches[0].clientX - sx;
      if(Math.abs(d) > 40) go(idx + (d < 0 ? 1 : -1));
    });
    layout();
  })();

  /* ---------- CONTACT FORM ---------- */
  var form = document.getElementById("contactForm");
  if(form){
    var status = document.getElementById("formStatus");
    var submit = form.querySelector("button[type=submit]");

    function say(text, ok){
      status.textContent = text;
      status.className = ok ? "ok" : "warn";
      status.style.display = "block";
    }

    form.addEventListener("submit", function(e){
      /* No fetch support? Let the browser POST the form normally. */
      if(!window.fetch) return;
      e.preventDefault();

      form.querySelectorAll(".field-error").forEach(function(n){ n.remove(); });
      submit.disabled = true;
      var label = submit.innerHTML;
      submit.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending…';

      fetch(form.action, {
        method: "POST",
        headers: {
          "Accept": "application/json",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": (window.Portfolio && window.Portfolio.csrf) || ""
        },
        body: new FormData(form)
      })
      .then(function(res){ return res.json().then(function(body){ return {status:res.status, body:body}; }); })
      .then(function(r){
        if(r.status === 422){
          var errors = r.body.errors || {};
          Object.keys(errors).forEach(function(key){
            var input = form.querySelector('[name="' + key + '"]');
            if(!input) return;
            var em = document.createElement("em");
            em.className = "field-error";
            em.textContent = errors[key][0];
            (input.closest(".field") || input.parentNode).appendChild(em);
          });
          say("Please check the highlighted fields.", false);
          return;
        }
        if(r.status === 429){
          say("That is a lot of messages in a short time. Please try again in a minute.", false);
          return;
        }
        say(r.body.message || "Thanks — your message is on its way.", r.body.ok !== false);
        if(r.body.ok !== false) form.reset();
      })
      .catch(function(){
        say("Something went wrong sending that. Please email me directly instead.", false);
      })
      .finally(function(){
        submit.disabled = false;
        submit.innerHTML = label;
      });
    });
  }

  /* ---------- DEPTH FIELD ---------- */
  (function(){
    if(REDUCED) return;
    var c = document.getElementById("depth"), x = c.getContext("2d");
    var dpr = Math.min(window.devicePixelRatio || 1, 2), W, H, pts = [];
    var COLORS = ["rgba(255,122,47,","rgba(139,107,255,","rgba(47,216,232,","rgba(255,255,255,"];
    function resize(){
      W = c.width = innerWidth*dpr; H = c.height = innerHeight*dpr;
      c.style.width = innerWidth + "px"; c.style.height = innerHeight + "px";
      var target = innerWidth < 700 ? 50 : 115;
      pts = [];
      for(var i = 0; i < target; i++){
        pts.push({x:Math.random()*2-1, y:Math.random()*2-1, z:Math.random()*.9+.1,
                  s:Math.random()*1.6+.4, c:COLORS[(Math.random()*COLORS.length)|0], v:Math.random()*.0016+.0006});
      }
    }
    var mx = 0, my = 0;
    window.addEventListener("mousemove", function(e){
      mx = (e.clientX/innerWidth - .5)*.12; my = (e.clientY/innerHeight - .5)*.12;
    }, {passive:true});
    function draw(){
      x.clearRect(0,0,W,H);
      var cx = W/2, cy = H/2, f = W*.62;
      for(var i = 0; i < pts.length; i++){
        var p = pts[i];
        p.z -= p.v;
        if(p.z <= .06){ p.z = 1; p.x = Math.random()*2-1; p.y = Math.random()*2-1; }
        x.beginPath();
        x.arc(cx + (p.x+mx)/p.z*f*.5, cy + (p.y+my)/p.z*f*.5, p.s/p.z*dpr*.8, 0, 6.283);
        x.fillStyle = p.c + Math.min((1-p.z)*.8, .6) + ")"; x.fill();
      }
      requestAnimationFrame(draw);
    }
    resize(); window.addEventListener("resize", resize); draw();
  })();

})();
