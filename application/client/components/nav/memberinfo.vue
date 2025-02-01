<script setup lang="ts">
import { useAuthStore } from '~/stores/auth';
import { useAuthentication } from '~/composables/authentication';
import { useUrlStore } from '~/stores/url';
import { watch } from 'vue';

const authStore = useAuthStore();
const { logout } = useAuthentication();
const colorMode = useColorMode();
const urlStore = useUrlStore();

const handleLogout = async () => {
  try {
    await logout();
  } catch (error) {
    console.error('登出失敗:', error);
  }
};

const handleToggleTheme = () => {
  urlStore.theme = urlStore.theme === 'dark' ? 'light' : 'dark';
};

// 監聽主題變更並同步到 colorMode
watch(() => urlStore.theme, (newTheme) => {
  colorMode.preference = newTheme;
});

const items = [[
  {
    label: '使用者資料',
    icon: 'i-heroicons-user-20-solid',
    to: '/user/member'
  },
  {
    label: '會員等級',
    icon: 'i-heroicons-star-20-solid',
    to: '/user/membership'
  }
], [
  {
    label: '登出',
    icon: 'i-heroicons-arrow-right-on-rectangle-20-solid',
    click: handleLogout
  }
]];
</script>

<template>
  <div class="flex items-center gap-2">
    <!-- 主題切換按鈕 -->
    <UButton
      color="gray"
      variant="ghost"
      :icon="colorMode.value === 'dark' ? 'i-heroicons-sun-20-solid' : 'i-heroicons-moon-20-solid'"
      @click="handleToggleTheme"
    />

    <!-- 未登入狀態 -->
    <NuxtLink 
      v-if="!authStore.isAuthenticated"
      to="/auth/login" 
      class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700"
    >
      登入
    </NuxtLink>

    <!-- 已登入狀態 -->
    <UDropdown 
      v-else 
      :items="items"
      mode="hover"
      :popper="{ placement: 'bottom-end' }"
    >
      <button class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md">
        {{ authStore.user?.name }}
        <UIcon name="i-heroicons-chevron-down-20-solid" class="ml-2" />
      </button>
    </UDropdown>
  </div>
</template>