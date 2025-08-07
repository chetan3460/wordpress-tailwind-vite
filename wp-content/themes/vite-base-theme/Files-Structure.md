your-theme/
│
├── assets/ # Source files only (not production-ready)
│ ├── css/
│ │ └── style.css # Tailwind CSS entry point
│ ├── js/
│ │ └── main.js # JS entry point
│ ├── images/ # Source/static images
│ └── fonts/ # Custom fonts (if any)
│
├── dist/ # Vite build output (auto-generated)
│ ├── css/
│ ├── js/
│ └── manifest.json
│
├── inc/ # Core PHP functionality
│ ├── core/ # Theme bootstrapping
│ │ ├── setup.php # Theme setup (supports, menus, etc.)
│ │ ├── enqueue.php # Enqueue CSS/JS from Vite
│ │ ├── helpers.php # Utility functions
│ │ └── init.php # Loads all files in `/core`
│ ├── features/ # Optional: isolated feature sets
│ │ ├── image-convert.php # WebP/AVIF conversion logic
│ │ ├── filters.php # Filters, shortcodes, etc.
│ │ ├── custom-posts.php # CPTs, taxonomies
│ │ └── walker-menu.php # Custom menu walker
│ └── acf/ # ACF-specific logic (sync, groups)
│ ├── fields.php
│ └── acf-json/ # ACF local JSON sync
│
├── templates/ # Main templates & layout parts
│ ├── parts/ # Reusable UI components
│ │ ├── hero.php
│ │ ├── menu.php
│ │ └── card-product.php
│ ├── layouts/ # Base layout shells
│ │ └── default.php
│ ├── global/ # Top-level templates
│ │ ├── header.php
│ │ └── footer.php
│ └── pages/ # Optional: custom page templates
│ ├── page-about.php
│ └── page-contact.php
│
├── functions.php # Loads `inc/core/init.php`
├── theme.json # WordPress theme configuration (FSE or not)
├── style.css # WordPress theme meta header
├── index.php # Default fallback
├── single.php
├── page.php
├── archive.php
├── 404.php
├── screenshot.png # Theme preview image
│
├── vite.config.js # Vite build configuration
├── tailwind.config.js # Tailwind configuration
├── postcss.config.js # PostCSS config for Tailwind/plugins
├── package.json
├── .gitignore
└── README.md
