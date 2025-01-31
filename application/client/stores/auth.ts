import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

// 定義用戶介面
interface User {
  name: string;
  email: string;
}

// 定義認證儲存庫
export const useAuthStore = defineStore('auth', () => {
  // 狀態管理
  const user = ref<User | null>(null);

  // 計算屬性
  const isAuthenticated = computed(() => !!user.value);

  // Actions
  const login = (userData: User) => {
    user.value = userData;
  };

  const logout = () => {
    user.value = null;
  };

  return {
    user,
    isAuthenticated,
    login,
    logout
  };
});