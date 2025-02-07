import { defineStore } from 'pinia';
import { ref } from 'vue';
//import { computed } from 'vue';

export const useUrlStore = defineStore('url', () => {
  // 獲取運行時配置
  //const config = useRuntimeConfig();
  
  // API 基礎 URL
  //const baseUrl = computed(() => `${config.public.apiBase}/shops`);
  const baseUrl = '/api';

  // 主題設定
  const theme = ref('dark');

  // 返回值
  return {
    baseUrl,
    theme
  };
}, {
  persist: {
    pick: ['theme'],
    storage: localStorage
  }
});