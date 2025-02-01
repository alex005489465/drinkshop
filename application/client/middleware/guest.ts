import { useAuthStore } from '~/stores/auth';

export default defineNuxtRouteMiddleware((to, from) => {
  const authStore = useAuthStore();

  // 檢查用戶是否已登入
  if (authStore.isAuthenticated) {
    // 若已登入，重定向至首頁
    return navigateTo('/');
  }
});
