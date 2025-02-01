import { useAuthStore } from '~/stores/auth';
import { useAuthentication } from '~/composables/authentication';

export default defineNuxtRouteMiddleware(async (to, from) => {
  const authStore = useAuthStore();
  const { loginCheck } = useAuthentication();

  // 檢查用戶登入狀態
  try {
    await loginCheck();
  } catch (error) {
    console.error('檢查登入狀態失敗:', error);
  }

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
