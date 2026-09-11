/* Concept One Developers — site interactions. No dependencies. */
(() => {
  "use strict";

  const $ = (s, r = document) => r.querySelector(s);
  const $$ = (s, r = document) => [...r.querySelectorAll(s)];
  const reduceMotion = matchMedia("(prefers-reduced-motion: reduce)").matches;

  /* ---- Header: solid once the page scrolls ---------------------------- */
  const header = $(".site-header");
  const fab = $(".fab"); // WhatsApp button waits until the hero is out of the way
  const onScroll = () => {
    header && header.classList.toggle("is-solid", scrollY > 40);
    fab && fab.classList.toggle("is-visible", scrollY > innerHeight * 0.5);
  };
  onScroll();
  addEventListener("scroll", onScroll, { passive: true });

  /* ---- Mobile menu ----------------------------------------------------- */
  const toggle = $(".menu-toggle");
  const setMenu = (open) => {
    document.body.classList.toggle("menu-open", open);
    toggle.setAttribute("aria-expanded", String(open));
    toggle.setAttribute("aria-label", open ? "Close menu" : "Open menu");
  };
  if (toggle) {
    toggle.addEventListener("click", () => setMenu(!document.body.classList.contains("menu-open")));
    $$(".mobile-menu a").forEach((a) => a.addEventListener("click", () => setMenu(false)));
    addEventListener("keydown", (e) => e.key === "Escape" && setMenu(false));
  }

  /* ---- Reveal on scroll ------------------------------------------------ */
  const revealables = $$("[data-reveal]");
  if ("IntersectionObserver" in window && !reduceMotion) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((en) => {
        if (en.isIntersecting) {
          en.target.classList.add("is-in");
          io.unobserve(en.target);
        }
      });
    }, { rootMargin: "0px 0px -8% 0px", threshold: 0.12 });
    revealables.forEach((el) => io.observe(el));
  } else {
    revealables.forEach((el) => el.classList.add("is-in"));
  }

  /* ---- Count-up figures ------------------------------------------------ */
  const countUp = (el) => {
    const target = parseFloat(el.dataset.count);
    const dec = parseInt(el.dataset.dec || "0", 10);
    const fmt = (n) => n.toLocaleString("en-IN", { minimumFractionDigits: dec, maximumFractionDigits: dec });
    if (reduceMotion) { el.textContent = fmt(target); return; }
    const start = performance.now();
    const dur = 1800;
    const tick = (now) => {
      const t = Math.min(1, (now - start) / dur);
      el.textContent = fmt(target * (1 - Math.pow(1 - t, 3)));
      if (t < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  };
  const counters = $$("[data-count]");
  if ("IntersectionObserver" in window) {
    const cio = new IntersectionObserver((entries) => {
      entries.forEach((en) => {
        if (en.isIntersecting) { countUp(en.target); cio.unobserve(en.target); }
      });
    }, { threshold: 0.6 });
    counters.forEach((el) => cio.observe(el));
  } else {
    counters.forEach(countUp);
  }

  /* ---- Hero slider ----------------------------------------------------- */
  const slider = $("[data-slider]");
  if (slider) {
    const slides = $$(".hero-slide", slider);
    const counter = $("[data-slide-index]", slider);
    const caption = $("[data-slide-caption]", slider);
    const progress = $(".hero-progress", slider);
    const DURATION = 6500;
    let index = 0;
    let timer = null;

    const go = (i) => {
      slides[index].classList.remove("is-active");
      index = (i + slides.length) % slides.length;
      const s = slides[index];
      s.classList.add("is-active");
      if (counter) counter.textContent = String(index + 1).padStart(2, "0");
      if (caption) {
        caption.href = s.dataset.href;
        $("strong", caption).textContent = s.dataset.name;
        $("span", caption).textContent = s.dataset.loc;
      }
      if (progress) {
        progress.classList.remove("is-running");
        void progress.offsetWidth; // restart the CSS animation
        if (timer) progress.classList.add("is-running");
      }
    };
    const play = () => {
      if (reduceMotion || slides.length < 2) return;
      clearInterval(timer);
      timer = setInterval(() => go(index + 1), DURATION);
      progress && (progress.classList.remove("is-running"), void progress.offsetWidth, progress.classList.add("is-running"));
    };
    $("[data-slide-prev]", slider)?.addEventListener("click", () => { go(index - 1); play(); });
    $("[data-slide-next]", slider)?.addEventListener("click", () => { go(index + 1); play(); });
    document.addEventListener("visibilitychange", () => {
      if (document.hidden) { clearInterval(timer); timer = null; } else play();
    });
    play();
  }

  /* ---- Project filtering ---------------------------------------------- */
  const BUDGETS = { "u1": [0, 1e7], "1-2": [1e7, 2e7], "2-4": [2e7, 4e7], "4+": [4e7, Infinity] };

  const applyFilter = (cards, f) => {
    let shown = 0;
    cards.forEach((card) => {
      const d = card.dataset;
      const price = parseFloat(d.price);
      const band = BUDGETS[f.budget];
      const ok =
        (!f.status || d.status === f.status) &&
        (!f.type || d.type === f.type) &&
        (!f.loc || d.loc === f.loc) &&
        (!band || (price >= band[0] && price < band[1])) &&
        (!f.q || d.search.includes(f.q.toLowerCase().trim()));
      if (ok && card.hidden) {
        card.hidden = false;
        card.classList.remove("is-shown");
        void card.offsetWidth;
        card.classList.add("is-shown");
      } else if (!ok) {
        card.hidden = true;
      }
      if (ok) shown++;
    });
    return shown;
  };

  // Home: status tabs
  $$("[data-filter-tabs]").forEach((group) => {
    const cards = $$(".card", $(group.dataset.filterTabs));
    $$("[data-status]", group).forEach((btn) => {
      btn.addEventListener("click", () => {
        $$("[data-status]", group).forEach((b) => b.setAttribute("aria-pressed", String(b === btn)));
        applyFilter(cards, { status: btn.dataset.status });
      });
    });
  });

  // Projects page: full filter bar
  const bar = $("[data-project-filters]");
  if (bar) {
    const cards = $$(".card", $("#project-grid"));
    const count = $("[data-result-count]");
    const empty = $("[data-empty]");
    const fields = { q: $("[name=q]", bar), type: $("[name=type]", bar), loc: $("[name=loc]", bar), budget: $("[name=budget]", bar) };
    const chips = $$("[data-status]", bar);

    const state = () => ({
      q: fields.q.value,
      type: fields.type.value,
      loc: fields.loc.value,
      budget: fields.budget.value,
      status: (chips.find((c) => c.getAttribute("aria-pressed") === "true") || {}).dataset?.status || "",
    });
    const run = () => {
      const s = state();
      const n = applyFilter(cards, s);
      count.textContent = n === 1 ? "1 project" : n + " projects";
      empty.hidden = n !== 0;
      const params = new URLSearchParams();
      Object.entries(s).forEach(([k, v]) => v && params.set(k, v));
      history.replaceState(null, "", location.pathname + (params.toString() ? "?" + params : ""));
    };

    chips.forEach((chip) => chip.addEventListener("click", () => {
      chips.forEach((c) => c.setAttribute("aria-pressed", String(c === chip)));
      run();
    }));
    Object.values(fields).forEach((el) => el.addEventListener(el.tagName === "INPUT" ? "input" : "change", run));
    bar.addEventListener("submit", (e) => { e.preventDefault(); run(); });
    $$("[data-reset]").forEach((b) => b.addEventListener("click", () => {
      fields.q.value = fields.type.value = fields.loc.value = fields.budget.value = "";
      chips.forEach((c, i) => c.setAttribute("aria-pressed", String(i === 0)));
      run();
    }));
    run();
  }

  /* ---- No Cost EMI calculator ------------------------------------------ */
  const inr = (n) => "₹" + Math.round(n).toLocaleString("en-IN");
  const inrShort = (n) => {
    if (n >= 1e7) return "₹" + (n / 1e7).toFixed(2).replace(/\.?0+$/, "") + " Cr";
    if (n >= 1e5) return "₹" + (n / 1e5).toFixed(1).replace(/\.0$/, "") + " L";
    return inr(n);
  };

  $$("[data-emi]").forEach((root) => {
    const inp = (n) => $(`[name=${n}]`, root);
    const out = (n) => $(`[data-out=${n}]`, root);
    const price = inp("price"), months = inp("months");
    const share = parseFloat(root.dataset.share) / 100; // part of the price on No Cost EMI

    const fill = (el) => el.style.setProperty("--fill", ((el.value - el.min) / (el.max - el.min)) * 100 + "%");

    // No interest: the covered share is simply split into equal monthly instalments.
    const calc = () => {
      [price, months].forEach(fill);
      const covered = price.value * share;
      out("price").textContent = inrShort(+price.value);
      out("months").textContent = months.value + " months";
      out("emi").textContent = inr(covered / months.value);
      out("term").textContent = "every month for " + months.value + " months";
      out("share").textContent = inr(covered);
      out("balance").textContent = inr(price.value - covered);
      root.style.setProperty("--p", share * 100 + "%");
    };
    [price, months].forEach((el) => el.addEventListener("input", calc));
    calc();
  });

  /* ---- Testimonials ---------------------------------------------------- */
  const quotes = $("[data-quotes]");
  if (quotes) {
    const items = $$(".quote", quotes);
    const dots = $$(".dot", quotes);
    let qi = 0;
    let qt = null;
    const show = (i) => {
      items[qi].classList.remove("is-active");
      dots[qi]?.setAttribute("aria-current", "false");
      qi = (i + items.length) % items.length;
      items[qi].classList.add("is-active");
      dots[qi]?.setAttribute("aria-current", "true");
    };
    const auto = () => { if (reduceMotion) return; clearInterval(qt); qt = setInterval(() => show(qi + 1), 7000); };
    dots.forEach((d, i) => d.addEventListener("click", () => { show(i); auto(); }));
    $("[data-quote-prev]", quotes)?.addEventListener("click", () => { show(qi - 1); auto(); });
    $("[data-quote-next]", quotes)?.addEventListener("click", () => { show(qi + 1); auto(); });
    quotes.addEventListener("mouseenter", () => clearInterval(qt));
    quotes.addEventListener("mouseleave", auto);
    auto();
  }

  /* ---- Gallery lightbox ----------------------------------------------- */
  const lb = $("#lightbox");
  const shots = $$("[data-lightbox]");
  if (lb && shots.length && typeof lb.showModal === "function") {
    const img = $("img", lb);
    const cnt = $("[data-lb-count]", lb);
    let li = 0;
    const open = (i) => {
      li = (i + shots.length) % shots.length;
      img.src = shots[li].href;
      img.alt = $("img", shots[li])?.alt || "";
      cnt.textContent = `${li + 1} / ${shots.length}`;
      if (!lb.open) lb.showModal();
    };
    shots.forEach((a, i) => a.addEventListener("click", (e) => { e.preventDefault(); open(i); }));
    $("[data-lb-prev]", lb).addEventListener("click", () => open(li - 1));
    $("[data-lb-next]", lb).addEventListener("click", () => open(li + 1));
    $("[data-lb-close]", lb).addEventListener("click", () => lb.close());
    lb.addEventListener("click", (e) => e.target === lb && lb.close());
    lb.addEventListener("keydown", (e) => {
      if (e.key === "ArrowLeft") open(li - 1);
      if (e.key === "ArrowRight") open(li + 1);
    });
  }

  /* ---- Project sub-navigation highlight ------------------------------- */
  const subnav = $(".subnav");
  if (subnav && "IntersectionObserver" in window) {
    const links = $$("a", subnav);
    const byId = new Map(links.map((a) => [a.hash.slice(1), a]));
    const sio = new IntersectionObserver((entries) => {
      entries.forEach((en) => {
        if (!en.isIntersecting) return;
        links.forEach((a) => a.classList.remove("is-current"));
        byId.get(en.target.id)?.classList.add("is-current");
      });
    }, { rootMargin: "-35% 0px -60% 0px" });
    byId.forEach((_, id) => { const s = document.getElementById(id); s && sio.observe(s); });
  }
})();
