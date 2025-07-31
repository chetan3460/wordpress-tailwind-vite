export default class Header {
  constructor({ header, htmlBody }) {
    this.header = header;
    this.htmlBody = htmlBody;
    this.bindEvents();
    this.stickyMenu();
    this.toggleMenu();
    this.markActiveMenu();

    this.submenuToggle();
  }

  bindEvents = () => { };

  //Sticky Menu
  stickyMenu = () => {
    let ticking = false;

    function windowScroll() {
      const navbar = document.getElementById('topnav');
      if (navbar) {
        navbar.classList.toggle('nav-sticky', window.scrollY >= 50);
      }
    }

    function onScroll() {
      if (!ticking) {
        requestAnimationFrame(() => {
          windowScroll();
          ticking = false;
        });
        ticking = true;
      }
    }

    window.addEventListener('scroll', onScroll);
  };

  /* Toggle Menu */
  toggleMenu = () => {
    const toggleBtn = document.getElementById('isToggle');
    const nav = document.getElementById('navigation');

    if (toggleBtn && nav) {
      toggleBtn.addEventListener('click', () => {
        toggleBtn.classList.toggle('open');

        const isCurrentlyVisible =
          window.getComputedStyle(nav).display === 'block';
        nav.style.display = isCurrentlyVisible ? 'none' : 'block';
      });
    }
  };

  // Add 'active' class to the current menu item based on the URL
  markActiveMenu() {
    const currentPath = window.location.pathname.replace(/\/$/, '');
    const menuLinks = document.querySelectorAll('#navigation a.sub-menu-item');

    menuLinks.forEach(link => {
      const href = link.getAttribute('href')?.replace(/\/$/, '');
      if (!href) return;

      // Match URL
      const isActive = href === currentPath || href.endsWith(currentPath);
      if (!isActive) return;

      link.classList.add('active');

      let li = link.closest('li');
      while (li) {
        li.classList.add('active');
        li = li.parentElement.closest('li');
      }

      // Also activate direct parent UL if it's submenu
      const submenu = link.closest('ul.submenu');
      if (submenu) submenu.classList.add('active');
    });
  }

  // Submenu Toggle
  // This function toggles the visibility of submenus when their parent menu item is clicked
  submenuToggle = () => {
    const nav = document.getElementById('navigation');

    if (nav) {
      const toggles = nav.querySelectorAll('a[href="javascript:void(0)"]');

      toggles.forEach(link => {
        link.addEventListener('click', e => {
          e.preventDefault();

          // Find the parent <li>
          const li = link.closest('li');
          if (!li) return;

          // Find the corresponding submenu
          const submenu = li.querySelector('.submenu');
          if (!submenu) return;

          // Close all other submenus first
          const allSubmenus = nav.querySelectorAll('.submenu.open');
          allSubmenus.forEach(menu => {
            if (menu !== submenu) {
              menu.classList.remove('open');
            }
          });

          // Toggle current submenu
          submenu.classList.toggle('open');
        });
      });
    }
  };
}
