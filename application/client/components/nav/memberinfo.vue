<script setup lang="ts">
import { useAuthStore } from '~/stores/auth';

const authStore = useAuthStore();
</script>

<template>
  <div>
    <!-- 未登入狀態 -->
    <NuxtLink 
      v-if="!authStore.isAuthenticated"
      to="/auth/login" 
      class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700"
    >
      登入
    </NuxtLink>

    <!-- 已登入狀態 -->
    <div 
      v-else
      class="px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-200"
    >
      歡迎{{ authStore.user?.name ? '，' + authStore.user.name : '' }}
    </div>
  </div>
</template>