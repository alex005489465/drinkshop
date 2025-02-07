// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  devtools: { enabled: true },
  modules: [
    '@pinia/nuxt',
    'pinia-plugin-persistedstate/nuxt', 
    '@nuxt/ui',
    '@nuxtjs/tailwindcss',
  ],
  ssr: false,
  hooks: {
    'prerender:routes' ({ routes }) {
      routes.clear() // Do not generate any routes (except the defaults)
    }
  },
  runtimeConfig: {
    public: {
      apiBase: '/api' // 可以根據需要修改
    }
  },
  nitro: {
    devProxy: {
      '/api': {
        target: 'http://localhost:8000/shops', // 代理目標地址
        changeOrigin: true,
        autoRewrite: true,
      },
    }
  },
  typescript: {
    typeCheck: true
  },
})