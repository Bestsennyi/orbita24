document.addEventListener('DOMContentLoaded', () => {
  const isCoarsePointer = window.matchMedia('(hover: none) and (pointer: coarse)').matches;

  const normalizeText = value => value.replace(/\s+/g, ' ').trim();
  const getCurrentPagePath = () => window.location.pathname;
  const trackingNavigationDelay = 150;

  const isPlainSameTabClick = (event, link) => {
    if (event.defaultPrevented) return false;
    if (event.button !== 0) return false;
    if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return false;
    if (link.target && link.target !== '_self') return false;
    if (link.hasAttribute('download')) return false;
    return true;
  };

  const pushTrackedEvent = (eventName, eventData, event, link) => {
    window.dataLayer = window.dataLayer || [];

    const payload = {
      event: eventName,
      ...eventData
    };

    if (!link || !isPlainSameTabClick(event, link)) {
      window.dataLayer.push(payload);
      return;
    }

    const url = new URL(link.href, window.location.href);
    const currentUrl = new URL(window.location.href);
    const isSamePage = url.href === currentUrl.href;

    if (isSamePage) {
      window.dataLayer.push(payload);
      return;
    }

    let didNavigate = false;
    const navigate = () => {
      if (didNavigate) return;
      didNavigate = true;
      window.location.href = url.href;
    };

    event.preventDefault();

    if (window.google_tag_manager) {
      payload.eventCallback = navigate;
      payload.eventTimeout = trackingNavigationDelay;
    }

    window.dataLayer.push(payload);
    window.setTimeout(navigate, trackingNavigationDelay);
  };

  const getLinkText = link => {
    const ariaLabel = normalizeText(link.getAttribute('aria-label') || '');
    return normalizeText(link.textContent || '') || ariaLabel || link.href;
  };

  const getButtonLocation = link => {
    if (link.dataset.location) return link.dataset.location;
    if (link.closest('.site-header')) return 'header';
    if (link.closest('.hero')) return 'hero';
    if (link.closest('.cta-section, .cta-block, .cta-box')) return 'cta_block';
    if (link.closest('.site-footer')) return 'footer';
    if (link.closest('.nav-menu')) return 'navigation';
    return 'content';
  };

  const isOptionsIndexLink = link => {
    const href = link.getAttribute('href');
    if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:')) return false;

    const url = new URL(href, window.location.href);
    const pathname = url.pathname.replace(/\/index\.html$/, '/').replace(/\/+$/, '');
    return pathname === '/optionen';
  };

  document.addEventListener('click', event => {
    const link = event.target.closest('a[href]');
    if (!link || !isOptionsIndexLink(link)) return;

    pushTrackedEvent('view_options_click', {
      button_location: getButtonLocation(link),
      button_text: getLinkText(link),
      page_path: getCurrentPagePath()
    }, event, link);
  }, true);

  document.addEventListener('click', event => {
    const el = event.target.closest('[data-offer="true"]');
    if (!el) return;

    const offerCard = el.closest('.offer-card, [data-offer-card], .card');
    const offerTitle = offerCard?.querySelector('h3, .offer-title, .card-title, h2, h1');
    const offer_name = normalizeText(offerTitle?.textContent || el.textContent || 'unknown');
    const offerGrid = offerCard?.closest('.offer-grid, .optionen-grid, .structure-grid, [data-offer-list], section, main');
    const offerCards = offerGrid
      ? Array.from(offerGrid.querySelectorAll('.offer-card, [data-offer-card], .card'))
          .filter(card => card.querySelector('[data-offer="true"]'))
      : [];
    const offerIndex = offerCard ? offerCards.indexOf(offerCard) : -1;
    const offer_position = offerIndex >= 0 ? offerIndex + 1 : 0;
    const link = el.closest('a[href]');

    pushTrackedEvent('affiliate_click', {
      offer_category: getOfferCategory(offerCard),
      offer_name,
      offer_position,
      offer_url: link?.href || el.href || '',
      page_path: getCurrentPagePath()
    }, event, link);
  }, true);

  const pushContactFormSubmit = (event, form) => {
    if (form.dataset.trackingSubmitted === 'true') return;

    const payload = {
      event: 'contact_form_submit',
      page_path: getCurrentPagePath()
    };

    window.dataLayer = window.dataLayer || [];

    if (!window.google_tag_manager) {
      window.dataLayer.push(payload);
      return;
    }

    let didSubmit = false;
    const submitForm = () => {
      if (didSubmit) return;
      didSubmit = true;
      form.dataset.trackingSubmitted = 'true';
      form.submit();
    };

    event.preventDefault();
    payload.eventCallback = submitForm;
    payload.eventTimeout = trackingNavigationDelay;
    window.dataLayer.push(payload);
    window.setTimeout(submitForm, trackingNavigationDelay);
  };

  const getOfferCategory = offerCard => {
    const pathParts = window.location.pathname.split('/').filter(Boolean);
    const optionenIndex = pathParts.indexOf('optionen');
    const categorySlug = optionenIndex >= 0
      ? pathParts[optionenIndex + 1]
      : '';

    if (categorySlug) {
      return categorySlug;
    }

    const section = offerCard?.closest('section, main');
    const categorySource = section?.querySelector(
      '.structure-breadcrumb a:last-of-type, .structure-breadcrumb-current, .section-title, .page-header h1, .structure-header h1'
    );
    const categoryText = normalizeText(categorySource?.textContent || '');

    return categoryText ? categoryText.toLowerCase() : 'unknown';
  };

  if (isCoarsePointer) {
    document.addEventListener('touchstart', () => {}, { passive: true });

    const tapTargetSelector = 'a, button, .btn, .card, .cta-box, .structure-card, .structure-back, .icon-list li';
    let activeTapTarget = null;
    let tapClearTimer = null;

    const clearTapTarget = (delay = 160) => {
      if (tapClearTimer) {
        window.clearTimeout(tapClearTimer);
      }

      tapClearTimer = window.setTimeout(() => {
        activeTapTarget?.classList.remove('is-tapping');
        activeTapTarget = null;
      }, delay);
    };

    document.addEventListener('pointerdown', event => {
      if (event.pointerType === 'mouse') return;

      const target = event.target.closest(tapTargetSelector);
      if (!target) return;
      if (target.closest('.site-header')) return;

      activeTapTarget?.classList.remove('is-tapping');
      activeTapTarget = target;
      target.classList.add('is-tapping');
    });

    ['pointerup', 'pointercancel', 'pointerleave'].forEach(eventName => {
      document.addEventListener(eventName, () => clearTapTarget(80), { passive: true });
    });
  }

  const navToggle = document.querySelector('.nav-toggle');
  const navMenu = document.querySelector('.nav-menu');
  const menuLinks = navMenu ? Array.from(navMenu.querySelectorAll('a')) : [];
  const headerLinks = Array.from(document.querySelectorAll('.site-header a[href]'));

  headerLinks.forEach(link => {
    link.addEventListener('click', event => {
      if (event.defaultPrevented || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
      if (link.target && link.target !== '_self') return;

      const href = link.getAttribute('href');
      if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:')) return;

      const url = new URL(href, window.location.href);
      const currentUrl = new URL(window.location.href);
      url.hash = '';
      currentUrl.hash = '';
      link.blur();

      if (url.href === currentUrl.href || link.classList.contains('is-optionen-active')) {
        event.preventDefault();
        return;
      }

      return;
    });
  });

  const closeMenu = () => {
    if (!navMenu || !navToggle) return;
    navMenu.classList.remove('is-open');
    navToggle.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('menu-open');
  };

  const openMenu = () => {
    if (!navMenu || !navToggle) return;
    navMenu.classList.add('is-open');
    navToggle.setAttribute('aria-expanded', 'true');
    document.body.classList.add('menu-open');
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
        if (window.innerWidth <= 1024) {
          closeMenu();
        }
      });
    });
  }

  const currentPathname = window.location.pathname;
  const currentFile = currentPathname.split('/').pop() || 'index.html';
  const isOptionenSection =
    currentPathname === '/optionen' ||
    currentPathname.startsWith('/optionen/') ||
    currentPathname.endsWith('/optionen.html');
  const normalizePath = path => (path === '' ? 'index.html' : path);

  document.body.classList.toggle('is-options-section', isOptionenSection);
  document.querySelectorAll('.site-header .nav-cta').forEach(button => {
    button.classList.toggle('is-active-section', isOptionenSection);
    button.classList.toggle('is-in-options', isOptionenSection);
  });

  document.querySelectorAll('.nav-menu a, .footer-links a').forEach(link => {
    const href = link.getAttribute('href');
    if (!href || href.startsWith('#') || href.startsWith('http')) return;

    const linkUrl = new URL(href, window.location.origin);
    const linkPathname = linkUrl.pathname;
    const isOptionenLink = linkPathname === '/optionen' || linkPathname === '/optionen/';
    const isHomeLink = linkPathname === '/';
    const linkPath = normalizePath(linkPathname.split('/').pop() || 'index.html');
    const isActive =
      (isOptionenLink && isOptionenSection) ||
      (isHomeLink && !isOptionenSection && (currentPathname === '/' || currentFile === 'index.html')) ||
      (!isOptionenLink && !isHomeLink && !isOptionenSection && linkPath === currentFile);

    if (isActive) {
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

  const scheduleAfterLoad = callback => {
    const run = () => {
      if ('requestIdleCallback' in window) {
        window.requestIdleCallback(callback, { timeout: 1600 });
      } else {
        window.setTimeout(callback, 350);
      }
    };

    if (document.readyState === 'complete') {
      run();
    } else {
      window.addEventListener('load', run, { once: true });
    }
  };

  const initScrollTopButton = () => {
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
  };

  scheduleAfterLoad(initScrollTopButton);

  const contactForm = document.querySelector('.contact-form');
  const formStatus = document.querySelector('.form-status');

  if (contactForm && formStatus) {
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

    contactForm.addEventListener('submit', event => {
      const name = contactForm.querySelector('#name');
      const email = contactForm.querySelector('#email');
      const message = contactForm.querySelector('#message');
      const honeypot = contactForm.querySelector('#website');
      let hasError = false;

      clearFieldErrors();
      formStatus.className = 'form-status';
      formStatus.textContent = '';

      if (honeypot && honeypot.value.trim() !== '') {
        event.preventDefault();
        formStatus.textContent = 'Ihre Nachricht konnte nicht gesendet werden.';
        formStatus.className = 'form-status is-visible is-error';
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

      pushContactFormSubmit(event, contactForm);
    });
  }
});
