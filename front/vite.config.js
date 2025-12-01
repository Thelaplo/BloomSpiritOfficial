import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'
// -------------------------------------------------------------
// NOUVELLES IMPORTATIONS POUR TAILWIND ET AUTOPREFIXER
import tailwindcssPostcss from '@tailwindcss/postcss'; // Import du nouveau paquet
import autoprefixer from 'autoprefixer';
// -------------------------------------------------------------

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    vueDevTools(),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    },
  },
  
  css: {
    postcss: {
      plugins: [
        // Utilisation des modules importés
        tailwindcssPostcss, 
        autoprefixer,
      ],
    },
  },
});