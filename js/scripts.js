    /* =====================================================
       1. MENU MOBILE — overlay con aria-expanded
    ===================================================== */
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');

    function toggleMenu(force) {
      const isOpen = typeof force === 'boolean'
        ? force
        : hamburger.getAttribute('aria-expanded') !== 'true';

      hamburger.setAttribute('aria-expanded', String(isOpen));
      hamburger.setAttribute('aria-label', isOpen ? 'Chiudi menu' : 'Apri menu');
      mobileMenu.classList.toggle('open', isOpen);
      document.body.style.overflow = isOpen ? 'hidden' : '';
    }

    hamburger.addEventListener('click', () => toggleMenu());
    mobileMenu.querySelectorAll('a').forEach(link =>
      link.addEventListener('click', () => toggleMenu(false))
    );
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') toggleMenu(false);
    });

    /* =====================================================
       2. EFFETTO TYPING — riga per riga, parola per parola
    ===================================================== */
    const lines = [...document.querySelectorAll('.hero-title .tline')];
    const manifesto = document.getElementById('manifesto');
    const heroBtn = document.getElementById('heroBtn');
    const cursor = document.createElement('span');
    cursor.className = 'cursor';
    cursor.setAttribute('aria-hidden', 'true');

    const TYPE_DELAY = 150;   // ms tra una parola e la successiva
    const LINE_DELAY = 380;   // pausa tra una riga e la successiva

    function typeLine(lineEl, words) {
      return new Promise(resolve => {
        lineEl.appendChild(cursor);
        let i = 0;
        (function nextWord() {
          if (i < words.length) {
            const w = document.createElement('span');
            w.textContent = words[i] + (i < words.length - 1 ? ' ' : '');
            lineEl.insertBefore(w, cursor);
            i++;
            setTimeout(nextWord, TYPE_DELAY);
          } else {
            resolve();
          }
        })();
      });
    }

    (async function startTyping() {
      for (const line of lines) {
        const words = line.dataset.line.split(' ');
        await typeLine(line, words);
        await new Promise(r => setTimeout(r, LINE_DELAY));
      }
      // Digitazione terminata: il cursore resta a lampeggiare, rivela manifesto e CTA
      manifesto.classList.add('visible');
      heroBtn.classList.add('visible');
    })();

    /* =====================================================
       3. CANVAS PARTICELLARE — sistema atomico interattivo
    ===================================================== */
    const canvas = document.getElementById('particles');
    const ctx = canvas.getContext('2d');
    const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    const mouse = { x: -9999, y: -9999 };
    let particles = [];

    function particleCount() {
      // Densità proporzionale allo schermo, sempre nel range 60–90
      const density = Math.round((canvas.width * canvas.height) / 16000);
      return Math.max(60, Math.min(90, density));
    }

    function initParticles() {
      particles = Array.from({ length: particleCount() }, () => ({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        r: 0.5 + Math.random(),                       // 0.5 – 1.5 px
        vx: (Math.random() - 0.5) * 0.22,             // deriva lenta e casuale
        vy: (Math.random() - 0.5) * 0.22,
        cyan: Math.random() < 0.12                    // rara micro-particella accento
      }));
    }

    function resizeCanvas() {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
      initParticles();
    }

    function tick() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);

      for (const p of particles) {
        // Interazione mouse (solo desktop): leggera repulsione radiale
        if (finePointer) {
          const dx = p.x - mouse.x;
          const dy = p.y - mouse.y;
          const dist = Math.hypot(dx, dy);
          if (dist < 120 && dist > 0.01) {
            const force = (1 - dist / 120) * 0.35;
            p.x += (dx / dist) * force;
            p.y += (dy / dist) * force;
          }
        }

        p.x += p.vx;
        p.y += p.vy;

        // Wrap-around sui bordi
        if (p.x < -4) p.x = canvas.width + 4;
        if (p.x > canvas.width + 4) p.x = -4;
        if (p.y < -4) p.y = canvas.height + 4;
        if (p.y > canvas.height + 4) p.y = -4;

        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
        ctx.fillStyle = p.cyan
          ? 'rgba(0, 255, 204, 0.55)'
          : 'rgba(255, 255, 255, 0.32)';
        ctx.fill();
      }

      requestAnimationFrame(tick);
    }

    window.addEventListener('resize', resizeCanvas);
    canvas.parentElement.addEventListener('mousemove', e => {
      const rect = canvas.getBoundingClientRect();
      mouse.x = e.clientX - rect.left;
      mouse.y = e.clientY - rect.top;
    });
    canvas.parentElement.addEventListener('mouseleave', () => {
      mouse.x = mouse.y = -9999;
    });

    resizeCanvas();
    tick();

    /* =====================================================
       4. REVEAL ON SCROLL + CONTATORI
    ===================================================== */
    const revealObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('visible');

        // Avvia i contatori numerici quando entrano in vista
        entry.target.querySelectorAll('[data-count]').forEach(el => {
          if (el.dataset.done) return;
          el.dataset.done = '1';
          const target = +el.dataset.count;
          const t0 = performance.now();
          (function count(t) {
            const k = Math.min((t - t0) / 1400, 1);
            el.textContent = Math.round(target * (1 - Math.pow(1 - k, 3)));
            if (k < 1) requestAnimationFrame(count);
          })(t0);
        });

        revealObserver.unobserve(entry.target);
      });
    }, { threshold: 0.15 });

    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

    /* =====================================================
       5. FISARMONICA BIOGRAFIE — Read more / Read less
    ===================================================== */
    document.querySelectorAll('.read-more-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const container = btn.parentElement;
        const bioShort = container.querySelector('.artist-bio');
        const bioFull = container.querySelector('.artist-bio-full');
        const isExpanded = bioFull.style.display === 'block';

        if (isExpanded) {
          bioFull.style.display = 'none';
          bioShort.style.display = 'block';
          btn.textContent = 'Leggi di più...';
        } else {
          bioFull.style.display = 'block';
          bioShort.style.display = 'none';
          btn.textContent = 'Chiudi';
        }
      });
    });

    /* =====================================================
       6. FORM CONTATTO — validazione minimale + feedback
    ===================================================== */
    const form = document.getElementById('contactForm');
    const status = document.getElementById('formStatus');

    form.addEventListener('submit', e => {
      e.preventDefault();
      const name = form.name.value.trim();
      const email = form.email.value.trim();
      const message = form.message.value.trim();

      if (!name || !email || !message) {
        status.textContent = '// ERROR: fill all fields';
        return;
      }
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        status.textContent = '// ERROR: invalid email format';
        return;
      }

      status.textContent = '// TRANSMISSION SENT — we will reply within 48h';
      form.reset();
      setTimeout(() => (status.textContent = ''), 6000);
    });