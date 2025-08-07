// vite.config.js
import { resolve } from 'path';
import tailwindcss from '@tailwindcss/vite';

import fs from 'fs';
import { loadEnv } from 'vite';
import liveReload from 'vite-plugin-live-reload';

const pkg = JSON.parse(fs.readFileSync('./package.json', 'utf8'));
const version = pkg.version;

export default ({ mode }) => {
    const env = loadEnv(mode, process.cwd());

    return {
        root: 'assets',
        base: '/',
        plugins: [
            liveReload([
                '../*.php',
                '../inc/**/*.php',
                '../templates/**/*.php',
            ]),
            tailwindcss(),
        ],
        css: {
            devSourcemap: true, // 💡 Show correct source line like main.css:344
        },
        build: {
            outDir: '../dist',
            emptyOutDir: true,
            manifest: true,
            manifestFileName: '.vite/manifest.json',
            cssCodeSplit: true,
            rollupOptions: {
                input: {
                    main: resolve(__dirname, 'assets/js/main.js'),
                },
                output: {
                    entryFileNames: `js/main-v${version}.js`,
                    chunkFileNames: `js/[name]-chunk-v${version}.js`,
                    assetFileNames: assetInfo => {
                        if (assetInfo.name.endsWith('.css')) {
                            return `css/style-v${version}.css`;
                        }
                        return `assets/[name]-v${version}[extname]`;
                    },
                },
            },
        },
        server: {
            port: parseInt(env.VITE_PORT),
            origin: env.VITE_ORIGIN,
            open: env.VITE_OPEN || 'http://localhost/wordpress-tailwind-vite/',
            watch: {
                usePolling: env.VITE_POLLING === 'true',
                interval: parseInt(env.VITE_POLLING_INTERVAL),
            },
            hmr: {
                host: 'localhost',
            },
        },
    };
};
