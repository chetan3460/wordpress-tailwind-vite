// vite.config.js
import { resolve } from 'path';
import fs from 'fs';
import liveReload from 'vite-plugin-live-reload';

const pkg = JSON.parse(fs.readFileSync('./package.json', 'utf8'));
const version = pkg.version;

export default {
    root: 'assets',
    base: '/',
    plugins: [
        liveReload([
            '../*.php',
            '../inc/**/*.php',
            '../templates/**/*.php',
        ]),
    ],
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
        port: 3000,
        origin: 'http://localhost:3000',
        watch: {
            usePolling: true,
            interval: 100,
        },
        hmr: {
            host: 'localhost',
        },
    },
};
