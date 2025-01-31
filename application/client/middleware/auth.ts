import { useAuthStore } from '~/stores/auth';

export default defineNuxtRouteMiddleware((to, from) => {
  const authStore = useAuthStore();

  // 檢查用戶是否已登入
  if (!authStore.isAuthenticated) {
    // 若未登入，重定向至登入頁面
    return navigateTo({
      path: '/auth/login',
      query: {
        redirect: to.fullPath
      }
    });
  }
});
