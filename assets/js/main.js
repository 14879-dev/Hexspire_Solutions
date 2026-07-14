/**
 * Hexspire Solutions — Public Site JavaScript
 * Dock nav, scrollspy, dynamic content, contact form, animations
 */

// ── Icons map (Lucide icon names → inline SVG paths) ──────────────────────
const ICONS = {
  'globe': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>`,
  'search': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>`,
  'smartphone': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>`,
  'bar-chart-2': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>`,
  'shield-check': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>`,
  'zap': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>`,
  'code': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>`,
  'layout': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>`,
  'image': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>`,
  'arrow-right': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>`,
  'external-link': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>`,
  'linkedin': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>`,
  'twitter': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.7 5.5 4.4 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>`,
  'github': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>`,
  'mail': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>`,
  'phone': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>`,
  'map-pin': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>`,
  'check-circle': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>`,
  'send': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>`,
  'chevron-down': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="6 9 12 15 18 9"/></svg>`,
  'facebook': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>`,
  'instagram': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>`,
};

function icon(name, cls = '') {
  const svg = ICONS[name] || ICONS['code'];
  const el = document.createElement('div');
  el.innerHTML = svg;
  const svgEl = el.firstChild;
  if (cls) svgEl.setAttribute('class', cls);
  svgEl.style.strokeWidth = '1.8';
  return svgEl;
}

// ── Logo Loader ────────────────────────────────────────────────────────────
async function loadLogo() {
  const badge = document.getElementById('logo-badge');
  if (!badge) return;
  try {
    const res = await fetch('api/settings.php?key=logo_path');
    const data = await res.json();
    if (data.value) {
      badge.innerHTML = `<img src="${data.value}" alt="Hexspire Solutions Logo" loading="lazy">`;
    }
  } catch (e) { /* use placeholder */ }
}

// ── Dock Navigation ────────────────────────────────────────────────────────
const DOCK_ITEMS = [
  { id: 'hero',     label: 'Home',     iconName: 'layout'    },
  { id: 'about',    label: 'About',    iconName: 'check-circle' },
  { id: 'services', label: 'Services', iconName: 'zap'        },
  { id: 'projects', label: 'Projects', iconName: 'image'      },
  { id: 'team',     label: 'Team',     iconName: 'github'     },
  { id: 'contact',  label: 'Contact',  iconName: 'mail'       },
];

function buildDock() {
  const nav = document.getElementById('dock-nav');
  if (!nav) return;

  DOCK_ITEMS.forEach(item => {
    const btn = document.createElement('button');
    btn.className = 'dock-item';
    btn.id = `dock-${item.id}`;
    btn.setAttribute('aria-label', item.label);
    btn.setAttribute('role', 'button');
    btn.setAttribute('tabindex', '0');

    const iconEl = icon(item.iconName);
    const tooltip = document.createElement('span');
    tooltip.className = 'dock-tooltip';
    tooltip.textContent = item.label;

    btn.appendChild(iconEl);
    btn.appendChild(tooltip);
    nav.appendChild(btn);

    btn.addEventListener('click', () => {
      const target = document.getElementById(item.id);
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });

    btn.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') btn.click();
    });
  });

  // Magnification effect
  nav.addEventListener('mousemove', e => {
    const items = nav.querySelectorAll('.dock-item');
    items.forEach(item => {
      const rect = item.getBoundingClientRect();
      const cx = rect.left + rect.width / 2;
      const dist = Math.abs(e.clientX - cx);
      const maxDist = 90;
      const scale = dist < maxDist ? 1 + 0.32 * (1 - dist / maxDist) : 1;
      item.style.transform = `scale(${scale.toFixed(3)})`;
      item.querySelector('svg').style.transform = `scale(${Math.min(scale, 1.18).toFixed(3)})`;
    });
  });

  nav.addEventListener('mouseleave', () => {
    nav.querySelectorAll('.dock-item').forEach(item => {
      item.style.transform = '';
      item.querySelector('svg').style.transform = '';
    });
  });
}

// ── Scrollspy ─────────────────────────────────────────────────────────────
function initScrollspy() {
  const sections = DOCK_ITEMS.map(i => document.getElementById(i.id)).filter(Boolean);
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Remove active from all
        document.querySelectorAll('.dock-item').forEach(d => d.classList.remove('active'));
        // Add active to current
        const activeBtn = document.getElementById(`dock-${entry.target.id}`);
        if (activeBtn) activeBtn.classList.add('active');
      }
    });
  }, { 
    threshold: 0, 
    rootMargin: window.innerWidth <= 768 ? '-20% 0px -60% 0px' : '-10% 0px -50% 0px' 
  });

  sections.forEach(s => observer.observe(s));

  // Default first active
  const firstBtn = document.getElementById('dock-hero');
  if (firstBtn) firstBtn.classList.add('active');
}

// ── Services ──────────────────────────────────────────────────────────────
async function loadServices() {
  const grid = document.getElementById('services-grid');
  if (!grid) return;

  try {
    const res = await fetch('api/services.php');
    const services = await res.json();

    if (!services.length) {
      grid.innerHTML = '<p class="text-center" style="color:var(--text-muted);grid-column:1/-1">No services found.</p>';
      return;
    }

    grid.innerHTML = '';
    services.forEach((svc, i) => {
      const card = document.createElement('div');
      card.className = `service-card fade-up fade-up-delay-${Math.min(i + 1, 5)}`;

      const iconEl = icon(svc.icon || 'zap');
      iconEl.style.strokeWidth = '1.8';

      card.innerHTML = `
        <div class="service-icon"></div>
        <h3>${escHtml(svc.title)}</h3>
        <p>${escHtml(svc.description)}</p>
        <span class="service-link">Learn More <span>${ICONS['arrow-right']}</span></span>
      `;
      card.querySelector('.service-icon').appendChild(iconEl);
      grid.appendChild(card);
    });

    observeFadeUp(grid.querySelectorAll('.fade-up'));
  } catch (e) {
    grid.innerHTML = '<p style="color:var(--text-muted);grid-column:1/-1;text-align:center;">Could not load services.</p>';
  }
}

// ── Projects ──────────────────────────────────────────────────────────────
let allProjects = [];
let activeFilter = 'All';

async function loadProjects() {
  const grid = document.getElementById('projects-grid');
  const filterWrap = document.getElementById('projects-filter');
  if (!grid) return;

  try {
    const res = await fetch('api/projects.php');
    allProjects = await res.json();

    // Build filter categories
    const cats = ['All', ...new Set(allProjects.map(p => p.category).filter(Boolean))];
    if (filterWrap) {
      filterWrap.innerHTML = '';
      cats.forEach(cat => {
        const btn = document.createElement('button');
        btn.className = `filter-btn${cat === 'All' ? ' active' : ''}`;
        btn.textContent = cat;
        btn.addEventListener('click', () => {
          filterWrap.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
          btn.classList.add('active');
          activeFilter = cat;
          renderProjects(cat);
        });
        filterWrap.appendChild(btn);
      });
    }

    renderProjects('All');
  } catch (e) {
    grid.innerHTML = '<p style="color:var(--text-muted);grid-column:1/-1;text-align:center;">Could not load projects.</p>';
  }
}

function renderProjects(filter) {
  const grid = document.getElementById('projects-grid');
  const filtered = filter === 'All' ? allProjects : allProjects.filter(p => p.category === filter);

  grid.innerHTML = '';

  if (!filtered.length) {
    grid.innerHTML = '<p style="color:var(--text-muted);grid-column:1/-1;text-align:center;">No projects in this category yet.</p>';
    return;
  }

  filtered.forEach((proj, i) => {
    const card = document.createElement('div');
    card.className = `project-card fade-up fade-up-delay-${Math.min(i + 1, 5)}`;

    const imgHtml = proj.image_path
      ? `<img src="${escHtml(proj.image_path)}" alt="${escHtml(proj.title)}" loading="lazy">`
      : `<div class="project-image-placeholder"><div>${ICONS['image']}</div></div>`;

    const link = proj.link && proj.link !== '#' ? proj.link : null;

    card.innerHTML = `
      <div class="project-image">
        ${imgHtml}
        <div class="project-overlay">
          ${link ? `<a href="${escHtml(link)}" target="_blank" rel="noopener" class="project-view-btn">${ICONS['external-link']} View Project</a>` : ''}
        </div>
      </div>
      <div class="project-info">
        <span class="project-category">${escHtml(proj.category || 'Project')}</span>
        <h3>${escHtml(proj.title)}</h3>
        <p>${escHtml(proj.description || '')}</p>
      </div>
    `;

    if (link) {
      card.style.cursor = 'pointer';
      card.addEventListener('click', e => {
        if (!e.target.closest('.project-view-btn')) {
          window.open(link, '_blank', 'noopener');
        }
      });
    }

    grid.appendChild(card);
  });

  observeFadeUp(grid.querySelectorAll('.fade-up'));
}

// ── Team ───────────────────────────────────────────────────────────────────
async function loadTeam() {
  const grid = document.getElementById('team-grid');
  if (!grid) return;

  try {
    const res = await fetch('api/team.php');
    const team = await res.json();

    if (!team.length) {
      grid.innerHTML = '<p style="color:var(--text-muted);grid-column:1/-1;text-align:center;">Team info coming soon.</p>';
      return;
    }

    grid.innerHTML = '';
    team.forEach((member, i) => {
      const card = document.createElement('div');
      card.className = `team-card fade-up fade-up-delay-${Math.min(i + 1, 5)}`;

      const initials = member.name.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
      const photoHtml = member.photo_path
        ? `<img class="team-photo" src="${escHtml(member.photo_path)}" alt="${escHtml(member.name)}" loading="lazy">`
        : `<div class="team-photo-placeholder">${initials}</div>`;

      const socials = [];
      if (member.linkedin) socials.push({ url: member.linkedin, icon: 'linkedin', label: 'LinkedIn' });
      if (member.twitter)  socials.push({ url: member.twitter,  icon: 'twitter',  label: 'Twitter' });
      if (member.github)   socials.push({ url: member.github,   icon: 'github',   label: 'GitHub' });

      const socialsHtml = socials.map(s =>
        `<a href="${escHtml(s.url)}" target="_blank" rel="noopener" class="team-social-link" aria-label="${s.label}">${ICONS[s.icon]}</a>`
      ).join('');

      card.innerHTML = `
        <div class="team-photo-wrap">${photoHtml}</div>
        <h3>${escHtml(member.name)}</h3>
        <p class="role">${escHtml(member.role || '')}</p>
        <div class="team-socials">${socialsHtml || '<span style="font-size:0.8rem;color:var(--text-muted)">—</span>'}</div>
      `;

      grid.appendChild(card);
    });

    observeFadeUp(grid.querySelectorAll('.fade-up'));
  } catch (e) {
    grid.innerHTML = '<p style="color:var(--text-muted);grid-column:1/-1;text-align:center;">Could not load team.</p>';
  }
}

// ── Contact Form ───────────────────────────────────────────────────────────
function initContactForm() {
  const form = document.getElementById('contact-form');
  if (!form) return;

  form.addEventListener('submit', async e => {
    e.preventDefault();
    const btn = form.querySelector('.form-submit');
    const msgEl = document.getElementById('form-message');

    const payload = {
      name:    form.querySelector('#cf-name').value.trim(),
      email:   form.querySelector('#cf-email').value.trim(),
      subject: form.querySelector('#cf-subject').value.trim(),
      message: form.querySelector('#cf-message').value.trim(),
    };

    if (!payload.name || !payload.email || !payload.subject || !payload.message) {
      msgEl.textContent = 'Please fill out all fields before sending.';
      msgEl.className = 'form-message error';
      msgEl.style.display = 'block';
      return;
    }

    btn.disabled = true;
    btn.innerHTML = `<span style="display:inline-block;width:18px;height:18px;border:2px solid #fff3;border-top-color:#fff;border-radius:50%;animation:spin 0.7s linear infinite"></span> Sending…`;
    msgEl.className = 'form-message';
    msgEl.style.display = 'none';

    try {
      const res = await fetch('api/contact.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
      });
      const data = await res.json();

      if (data.success) {
        msgEl.textContent = "Message sent! We will get back to you shortly.";
        msgEl.className = 'form-message success';
        form.reset();
      } else {
        msgEl.textContent = (data.errors || [data.error || 'Something went wrong.']).join(' ');
        msgEl.className = 'form-message error';
      }
    } catch (err) {
      msgEl.textContent = 'Network error. Please try again.';
      msgEl.className = 'form-message error';
    } finally {
      btn.disabled = false;
      btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg> Send Message`;
    }
  });
}

// ── Scroll Animations ──────────────────────────────────────────────────────
function observeFadeUp(elements) {
  const obs = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });

  elements.forEach(el => obs.observe(el));
}

function initFadeUps() {
  observeFadeUp(document.querySelectorAll('.fade-up:not(.service-card):not(.project-card):not(.team-card)'));
}

// ── Animated Counters ──────────────────────────────────────────────────────
function animateCounter(el, target, suffix = '') {
  const duration = 2000;
  const start = performance.now();
  const update = (time) => {
    const elapsed = time - start;
    const progress = Math.min(elapsed / duration, 1);
    const eased = 1 - Math.pow(1 - progress, 3);
    el.textContent = Math.round(eased * target) + suffix;
    if (progress < 1) requestAnimationFrame(update);
  };
  requestAnimationFrame(update);
}

function initCounters() {
  const counters = document.querySelectorAll('[data-count]');
  const obs = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;
        const target = parseInt(el.dataset.count, 10);
        const suffix = el.dataset.suffix || '';
        animateCounter(el, target, suffix);
        obs.unobserve(el);
      }
    });
  }, { threshold: 0.5 });
  counters.forEach(c => obs.observe(c));
}

// ── Utility ────────────────────────────────────────────────────────────────
function escHtml(str) {
  if (!str) return '';
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');
}

// Spin keyframe injection
const spinStyle = document.createElement('style');
spinStyle.textContent = `@keyframes spin { to { transform: rotate(360deg); } }`;
document.head.appendChild(spinStyle);

// ── Init ───────────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
  buildDock();
  initScrollspy();
  loadLogo();
  loadServices();
  loadProjects();
  loadTeam();
  initContactForm();
  initFadeUps();
  initCounters();
});
