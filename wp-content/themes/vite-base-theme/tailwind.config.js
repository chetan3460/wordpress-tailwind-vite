// tailwind.config.js
export default {
    content: [
        './*.php',
        './inc/**/*.php',
        './templates/**/*.php',
        './assets/**/*.{js,css}',
        './assets/css/editor-style.css'

    ],
    safelist: [
        'wp-block-post-title',
        'wp-block-post-time-to-read',
        'editor-styles-wrapper',
        'is-layout-flex',
        'is-layout-grid',
        'wp-block'
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};
