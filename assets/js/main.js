/* ConceptOne Developers — site interactions. No dependencies. */
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

  /* ---- Desktop dropdowns ----------------------------------------------- */
  // Hover and focus open them in CSS; the caret button toggles them for
  // touch and keyboard users and keeps aria-expanded truthful.
  const dropdowns = $$("[data-dropdown]");
  const closeDropdowns = (except) => dropdowns.forEach((d) => {
    if (d === except) return;
    d.classList.remove("is-open");
    $(".nav-caret", d).setAttribute("aria-expanded", "false");
  });
  dropdowns.forEach((d) => {
    const caret = $(".nav-caret", d);
    caret.addEventListener("click", () => {
      const open = !d.classList.contains("is-open");
      closeDropdowns(d);
      d.classList.toggle("is-open", open);
      caret.setAttribute("aria-expanded", String(open));
    });
    // Same-page anchors keep focus inside the menu; drop it so the menu closes.
    $$(".nav-menu a", d).forEach((a) => a.addEventListener("click", () => { closeDropdowns(); a.blur(); }));
  });
  document.addEventListener("click", (e) => { if (!e.target.closest("[data-dropdown]")) closeDropdowns(); });

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
  }
  addEventListener("keydown", (e) => {
    if (e.key !== "Escape") return;
    closeDropdowns();
    toggle && setMenu(false);
  });

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
    const fmt = (n) => Math.round(n).toLocaleString("en-IN");
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

  /* ---- In-page sub-navigation highlight -------------------------------- */
  const subnav = $(".subnav");
  if (subnav && "IntersectionObserver" in window) {
    const links = $$("a", subnav);
    const byId = new Map(links.map((a) => [a.hash.slice(1), a]));
    const sio = new IntersectionObserver((entries) => {
      entries.forEach((en) => {
        if (!en.isIntersecting) return;
        links.forEach((a) => a.classList.remove("is-current"));
        const link = byId.get(en.target.id);
        if (link) {
          link.classList.add("is-current");
          // Keep the active tab visible when the bar scrolls sideways on phones.
          link.parentElement.parentElement.scrollTo({ left: link.offsetLeft - 16, behavior: reduceMotion ? "auto" : "smooth" });
        }
      });
    }, { rootMargin: "-35% 0px -60% 0px" });
    byId.forEach((_, id) => { const s = document.getElementById(id); s && sio.observe(s); });
  }
})();
