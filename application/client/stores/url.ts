import { defineStore } from 'pinia';
//import { computed } from 'vue';

export const useUrlStore = defineStore('url', () => {
  // 獲取運行時配置
  //const config = useRuntimeConfig();
  
  // API 基礎 URL
  //const baseUrl = computed(() => `${config.public.apiBase}/shops`);
  const baseUrl = '/shops/shops';

  // 返回值
  return {
    baseUrl
  };
});