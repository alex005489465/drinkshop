// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  devtools: { enabled: true },
  css: ['~/assets/css/main.css'],
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },
  modules: [
    '@nuxtjs/color-mode'
  ],
  /*
  colorMode: {
    preference: 'system', // Default theme: 'light', 'dark' or 'system'
    fallback: 'light', // Fallback theme when the system preference is not available
    classSuffix: ''
  }
  */
    
})