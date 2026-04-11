document.addEventListener('DOMContentLoaded', () => {
  const navToggle = document.querySelector('.nav-toggle');
  const navMenu = document.querySelector('.nav-menu');

  if (navToggle && navMenu) {
    navToggle.addEventListener('click', () => {
      const isOpen = navMenu.classList.toggle('is-open');
      navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    document.addEventListener('click', event => {
      const clickedInsideMenu = navMenu.contains(event.target);
      const clickedToggle = navToggle.contains(event.target);

      if (!clickedInsideMenu && !clickedToggle && navMenu.classList.contains('is-open')) {
        navMenu.classList.remove('is-open');
        navToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  const smoothLinks = document.querySelectorAll('.smooth-scroll');

  smoothLinks.forEach(link => {
    link.addEventListener('click', event => {
      const href = link.getAttribute('href');
      if (!href || !href.startsWith('#')) return;

      const target = document.querySelector(href);
      if (!target) return;

      event.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });

      if (navMenu && navMenu.classList.contains('is-open')) {
        navMenu.classList.remove('is-open');
        navToggle?.setAttribute('aria-expanded', 'false');
      }
    });
  });

  const scrollTopButton = document.createElement('button');
  scrollTopButton.className = 'scroll-top';
  scrollTopButton.setAttribute('type', 'button');
  scrollTopButton.setAttribute('aria-label', 'Nach oben');
  scrollTopButton.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" fill="none">
      <g stroke="currentColor" stroke-width="10" stroke-linecap="round" stroke-linejoin="round">
        <path d="M64 26v76" />
        <path d="M34 54l30-30 30 30" />
      </g>
    </svg>
  `;

  document.body.appendChild(scrollTopButton);

  const toggleScrollTopButton = () => {
    if (window.scrollY > 320) {
      scrollTopButton.classList.add('is-visible');
    } else {
      scrollTopButton.classList.remove('is-visible');
    }
  };

  window.addEventListener('scroll', toggleScrollTopButton, { passive: true });
  toggleScrollTopButton();

  scrollTopButton.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
});
