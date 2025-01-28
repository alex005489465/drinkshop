// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2024-11-01',
  devtools: { enabled: true },
  modules: [
    '@pinia/nuxt',
    'pinia-plugin-persistedstate/nuxt', 
    '@nuxt/ui'
  ],
  ssr: false,
  runtimeConfig: {
    public: {
      apiBase: '/api' // 可以根據需要修改
    }
  },
  nitro: {
    devProxy: {
      '/api': {
        target: 'http://localhost:8000', // 代理目標地址
        changeOrigin: true,
        autoRewrite: true
      }
    }
  },
  typescript: {
    typeCheck: true
  }
})