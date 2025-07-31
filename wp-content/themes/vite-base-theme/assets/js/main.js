import '../css/style.css';
console.log('Vite + Tailwind + WordPress theme loaded !');

// src/js/app.js
import './helpers/jquery';

import DynamicImports from './components/DynamicImports';

export default new (class App {
    constructor() {
        this.setDomMap();
        $(() => {
            this.domReady();
        });
    }

    domReady = () => {
        this.bindEvents();
        new DynamicImports();
        // injectVersion();
        this.darkMode();
        this.accordion();
    };

    setDomMap = () => {
        this.window = $(window);
        this.htmlNbody = $('body, html');
        this.html = $('html');
        this.htmlBody = $('body');
        this.header = $('header');
        this.gotoTop = $('#gotoTop');
        this.wrapper = $('.wrapper');
        this.footer = $('footer');
        this.pushDiv = this.wrapper.find('.push');
    };

    bindEvents = () => {
    };

    // Dark Mode Toggle
    // This function toggles the dark mode by adding or removing the 'dark' class on the HTML tag
    darkMode = () => {
        try {
            function changeTheme(e) {
                e.preventDefault();
                const htmlTag = document.getElementsByTagName('html')[0];

                if (htmlTag.className.includes('dark')) {
                    htmlTag.className = 'light';
                } else {
                    htmlTag.className = 'dark';
                }
            }

            const switcher = document.getElementById('theme-mode');
            switcher?.addEventListener('click', changeTheme);

            const chk = document.getElementById('chk');

            chk.addEventListener('change', changeTheme);
        } catch (err) { }
    };



    // Accordion functionality
    accordion = () => {
        try {
            const Default = {
                alwaysOpen: false,
                activeClasses: 'bg-gray-50 dark:bg-slate-800 text-indigo-600',
                inactiveClasses: 'text-dark dark:text-white',
                onOpen: () => { },
                onClose: () => { },
                onToggle: () => { },
            };

            class Accordion {
                constructor(items = [], options = {}) {
                    this._items = items;
                    this._options = { ...Default, ...options };
                    this._init();
                }

                _init() {
                    if (this._items.length) {
                        // show accordion item based on click
                        this._items.map(item => {
                            if (item.active) {
                                this.open(item.id);
                            }

                            item.triggerEl.addEventListener('click', () => {
                                this.toggle(item.id);
                            });
                        });
                    }
                }

                getItem(id) {
                    return this._items.filter(item => item.id === id)[0];
                }

                open(id) {
                    const item = this.getItem(id);

                    // don't hide other accordions if always open
                    if (!this._options.alwaysOpen) {
                        this._items.map(i => {
                            if (i !== item) {
                                i.triggerEl.classList.remove(
                                    ...this._options.activeClasses.split(' ')
                                );
                                i.triggerEl.classList.add(
                                    ...this._options.inactiveClasses.split(' ')
                                );
                                i.targetEl.classList.add('hidden');
                                i.triggerEl.setAttribute('aria-expanded', false);
                                i.active = false;

                                // rotate icon if set
                                if (i.iconEl) {
                                    i.iconEl.classList.remove('rotate-180');
                                }
                            }
                        });
                    }

                    // show active item
                    item.triggerEl.classList.add(
                        ...this._options.activeClasses.split(' ')
                    );
                    item.triggerEl.classList.remove(
                        ...this._options.inactiveClasses.split(' ')
                    );
                    item.triggerEl.setAttribute('aria-expanded', true);
                    item.targetEl.classList.remove('hidden');
                    item.active = true;

                    // rotate icon if set
                    if (item.iconEl) {
                        item.iconEl.classList.add('rotate-180');
                    }

                    // callback function
                    this._options.onOpen(this, item);
                }

                toggle(id) {
                    const item = this.getItem(id);

                    if (item.active) {
                        this.close(id);
                    } else {
                        this.open(id);
                    }

                    // callback function
                    this._options.onToggle(this, item);
                }

                close(id) {
                    const item = this.getItem(id);

                    item.triggerEl.classList.remove(
                        ...this._options.activeClasses.split(' ')
                    );
                    item.triggerEl.classList.add(
                        ...this._options.inactiveClasses.split(' ')
                    );
                    item.targetEl.classList.add('hidden');
                    item.triggerEl.setAttribute('aria-expanded', false);
                    item.active = false;

                    // rotate icon if set
                    if (item.iconEl) {
                        item.iconEl.classList.remove('rotate-180');
                    }

                    // callback function
                    this._options.onClose(this, item);
                }
            }

            window.Accordion = Accordion;

            document.querySelectorAll('[data-accordion]').forEach(accordionEl => {
                const alwaysOpen = accordionEl.getAttribute('data-accordion');
                const activeClasses = accordionEl.getAttribute('data-active-classes');
                const inactiveClasses = accordionEl.getAttribute(
                    'data-inactive-classes'
                );

                const items = [];
                accordionEl.querySelectorAll('[data-accordion-target]').forEach(el => {
                    const item = {
                        id: el.getAttribute('data-accordion-target'),
                        triggerEl: el,
                        targetEl: document.querySelector(
                            el.getAttribute('data-accordion-target')
                        ),
                        iconEl: el.querySelector('[data-accordion-icon]'),
                        active: el.getAttribute('aria-expanded') === 'true' ? true : false,
                    };
                    items.push(item);
                });

                new Accordion(items, {
                    alwaysOpen: alwaysOpen === 'open' ? true : false,
                    activeClasses: activeClasses ? activeClasses : Default.activeClasses,
                    inactiveClasses: inactiveClasses
                        ? inactiveClasses
                        : Default.inactiveClasses,
                });
            });
        } catch (error) { }
    };
})();
