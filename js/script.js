document.addEventListener('DOMContentLoaded', () => {
  const body = document.body;
  const header = document.querySelector('.site-header');
  const navToggle = document.querySelector('.nav-toggle');
  const navMenu = document.querySelector('.nav-menu');
  const menuLinks = navMenu ? Array.from(navMenu.querySelectorAll('a')) : [];

  const closeMenu = () => {
    if (!navMenu || !navToggle) return;
    navMenu.classList.remove('is-open');
    navToggle.setAttribute('aria-expanded', 'false');
    body.classList.remove('menu-open');
  };

  const openMenu = () => {
    if (!navMenu || !navToggle) return;
    navMenu.classList.add('is-open');
    navToggle.setAttribute('aria-expanded', 'true');
    body.classList.add('menu-open');
  };

  if (navToggle && navMenu) {
    navToggle.addEventListener('click', () => {
      const isOpen = navMenu.classList.contains('is-open');
      if (isOpen) {
        closeMenu();
      } else {
        openMenu();
      }
    });

    document.addEventListener('click', event => {
      const clickedInsideMenu = navMenu.contains(event.target);
      const clickedToggle = navToggle.contains(event.target);

      if (!clickedInsideMenu && !clickedToggle && navMenu.classList.contains('is-open')) {
        closeMenu();
      }
    });

    document.addEventListener('keydown', event => {
      if (event.key === 'Escape' && navMenu.classList.contains('is-open')) {
        closeMenu();
        navToggle.focus();
      }
    });

    menuLinks.forEach(link => {
      link.addEventListener('click', () => {
        if (window.innerWidth < 992) {
          closeMenu();
        }
      });
    });
  }

  const currentPath = window.location.pathname.split('/').pop() || 'index.html';
  const normalizePath = path => (path === '' ? 'index.html' : path);

  document.querySelectorAll('.nav-menu a, .footer-links a').forEach(link => {
    const href = link.getAttribute('href');
    if (!href || href.startsWith('#') || href.startsWith('http')) return;

    const linkPath = normalizePath(href.split('/').pop() || 'index.html');
    if (linkPath === currentPath) {
      link.classList.add('active');
      if (link.closest('.nav-menu')) {
        link.setAttribute('aria-current', 'page');
      }
    } else {
      link.classList.remove('active');
      link.removeAttribute('aria-current');
    }
  });

  const smoothLinks = document.querySelectorAll('.smooth-scroll');
  smoothLinks.forEach(link => {
    link.addEventListener('click', event => {
      const href = link.getAttribute('href');
      if (!href || !href.startsWith('#')) return;

      const target = document.querySelector(href);
      if (!target) return;

      event.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      closeMenu();
    });
  });

  const handleHeaderState = () => {
    if (!header) return;
    header.classList.toggle('is-scrolled', window.scrollY > 12);
  };

  window.addEventListener('scroll', handleHeaderState, { passive: true });
  handleHeaderState();

  const scrollTopButton = document.createElement('button');
  const siteFooter = document.querySelector('.site-footer');
  scrollTopButton.className = 'scroll-top';
  scrollTopButton.type = 'button';
  scrollTopButton.setAttribute('aria-label', 'Nach oben');
  scrollTopButton.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" fill="none">
      <g stroke="currentColor" stroke-width="10" stroke-linecap="round" stroke-linejoin="round">
        <path d="M64 26v76" />
        <path d="M34 54l30-30 30 30" />
      </g>
    </svg>
  `;

  if (siteFooter) {
    siteFooter.before(scrollTopButton);
  } else {
    document.body.appendChild(scrollTopButton);
  }

  const updateScrollTopPosition = () => {
    if (!siteFooter) return;

    const footerRect = siteFooter.getBoundingClientRect();
    const isMobile = window.matchMedia('(max-width: 767px)').matches;
    const canOverlapFooter = window.matchMedia('(min-width: 768px)').matches;

    if (isMobile && footerRect.top < window.innerHeight) {
      if (scrollTopButton.parentElement !== siteFooter) {
        siteFooter.appendChild(scrollTopButton);
      }

      scrollTopButton.classList.add('is-footer-docked');
      scrollTopButton.style.removeProperty('--scroll-top-bottom');
      return;
    }

    if (scrollTopButton.parentElement === siteFooter) {
      siteFooter.before(scrollTopButton);
    }

    scrollTopButton.classList.remove('is-footer-docked');

    const safeGap = canOverlapFooter ? -10 : 16;
    const defaultBottom = 24;
    const buttonHeight = scrollTopButton.offsetHeight || 44;
    const maxBottom = Math.max(defaultBottom, window.innerHeight - buttonHeight - safeGap);
    const footerOffset = window.innerHeight - footerRect.top + safeGap;
    const nextBottom = footerRect.top < window.innerHeight
      ? Math.min(Math.max(defaultBottom, footerOffset), maxBottom)
      : defaultBottom;

    scrollTopButton.style.setProperty('--scroll-top-bottom', `${Math.round(nextBottom)}px`);
  };

  let isScrollTopMagnetActive = false;

  const resetScrollTopTransform = () => {
    scrollTopButton.style.removeProperty('transform');
  };

  const toggleScrollTopButton = () => {
    const isVisible = window.scrollY > 200;
    scrollTopButton.classList.toggle('visible', isVisible);
    if (!isVisible) {
      isScrollTopMagnetActive = false;
      resetScrollTopTransform();
      updateScrollTopPosition();
      return;
    }

    if (!isScrollTopMagnetActive) {
      resetScrollTopTransform();
    }
    updateScrollTopPosition();
  };

  window.addEventListener('scroll', toggleScrollTopButton, { passive: true });
  window.addEventListener('resize', updateScrollTopPosition);
  toggleScrollTopButton();
  updateScrollTopPosition();

  scrollTopButton.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  scrollTopButton.addEventListener('mousemove', event => {
    if (!scrollTopButton.classList.contains('visible')) return;

    isScrollTopMagnetActive = true;
    const rect = scrollTopButton.getBoundingClientRect();
    const offsetX = event.clientX - rect.left - rect.width / 2;
    const offsetY = event.clientY - rect.top - rect.height / 2;
    const x = (offsetX / (rect.width / 2)) * 5;
    const y = (offsetY / (rect.height / 2)) * 5;

    scrollTopButton.style.transform = `translate(${x.toFixed(2)}px, ${y.toFixed(2)}px)`;
  });

  scrollTopButton.addEventListener('mouseleave', () => {
    isScrollTopMagnetActive = false;
    resetScrollTopTransform();
  });

  const contactForm = document.querySelector('.contact-form');
  const formStatus = document.querySelector('.form-status');

  if (contactForm && formStatus) {
    const setFormStatus = (type, text) => {
      formStatus.textContent = text;
      formStatus.className = `form-status is-visible is-${type}`;
    };

    const fieldErrors = {
      name: document.querySelector('#name-error'),
      email: document.querySelector('#email-error'),
      message: document.querySelector('#message-error'),
    };

    const setFieldError = (field, errorElement, text) => {
      if (!field || !errorElement) return;

      errorElement.textContent = text;
      errorElement.style.display = text ? 'block' : 'none';
      field.setAttribute('aria-invalid', text ? 'true' : 'false');
      field.style.borderColor = text ? 'rgba(255, 90, 31, 0.34)' : '';
    };

    const clearFieldErrors = () => {
      setFieldError(contactForm.querySelector('#name'), fieldErrors.name, '');
      setFieldError(contactForm.querySelector('#email'), fieldErrors.email, '');
      setFieldError(contactForm.querySelector('#message'), fieldErrors.message, '');
    };

    const params = new URLSearchParams(window.location.search);
    const status = params.get('status');

    if (status === 'sent') {
      setFormStatus('success', 'Vielen Dank. Ihre Nachricht wurde gesendet.');
      window.history.replaceState({}, document.title, window.location.pathname);
    } else if (status === 'error') {
      setFormStatus(
        'error',
        'Bitte prüfen Sie Ihre Angaben und versuchen Sie es noch einmal.'
      );
      window.history.replaceState({}, document.title, window.location.pathname);
    }

    contactForm.addEventListener('submit', async event => {
      const name = contactForm.querySelector('#name');
      const email = contactForm.querySelector('#email');
      const message = contactForm.querySelector('#message');
      const honeypot = contactForm.querySelector('#website');
      const submitButton = contactForm.querySelector('button[type="submit"]');
      let hasError = false;

      clearFieldErrors();
      formStatus.className = 'form-status';
      formStatus.textContent = '';

      if (honeypot && honeypot.value.trim() !== '') {
        event.preventDefault();
        setFormStatus('error', 'Ihre Nachricht konnte nicht gesendet werden.');
        return;
      }

      if (!name?.value.trim()) {
        setFieldError(name, fieldErrors.name, 'Bitte geben Sie Ihren Namen ein.');
        hasError = true;
      }

      if (!email?.validity.valid) {
        setFieldError(email, fieldErrors.email, 'Bitte geben Sie eine gültige E-Mail-Adresse ein.');
        hasError = true;
      }

      if (!message?.value.trim()) {
        setFieldError(message, fieldErrors.message, 'Bitte geben Sie eine Nachricht ein.');
        hasError = true;
      }

      if (hasError) {
        event.preventDefault();
        return;
      }

      if (!window.fetch) return;

      event.preventDefault();

      try {
        if (submitButton) submitButton.disabled = true;

        const response = await fetch(contactForm.action, {
          method: 'POST',
          body: new FormData(contactForm),
          headers: { Accept: 'text/html' },
        });

        const resultUrl = response.url || '';
        if (resultUrl.includes('status=sent')) {
          contactForm.reset();
          setFormStatus('success', 'Vielen Dank. Ihre Nachricht wurde gesendet.');
        } else {
          setFormStatus('error', 'Bitte prüfen Sie Ihre Angaben und versuchen Sie es noch einmal.');
        }
      } catch (error) {
        contactForm.submit();
      } finally {
        if (submitButton) submitButton.disabled = false;
      }
    });
  }
});
