<script setup lang="ts">
definePageMeta({
  middleware: ['auth']
});

import { useUserProfile } from '~/composables/userprofile';
import { useUserStore } from '~/stores/user';

const userStore = useUserStore();
const { fetchMemberDetails } = useUserProfile();

// 初始化數據
await fetchMemberDetails();

// 從 store 獲取會員資料
const memberDetail = computed(() => userStore.memberDetail);
</script>

<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- 頁面標題 -->
      <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">會員等級</h1>
      </div>

      <!-- 會員資料區塊 -->
      <UCard>
        <template #header>
          <h2 class="text-xl font-semibold">會員資訊</h2>
        </template>
        <div class="space-y-4">
          <!-- 會員等級 -->
          <div class="grid grid-cols-4 gap-4">
            <div class="text-gray-600 dark:text-gray-400">會員等級</div>
            <div class="col-span-3">{{ memberDetail?.membership_level }}</div>
          </div>

          <!-- 點數餘額 -->
          <div class="grid grid-cols-4 gap-4">
            <div class="text-gray-600 dark:text-gray-400">點數餘額</div>
            <div class="col-span-3">{{ memberDetail?.points_balance }}</div>
          </div>

          <!-- 點數到期時間 -->
          <div class="grid grid-cols-4 gap-4">
            <div class="text-gray-600 dark:text-gray-400">點數到期時間</div>
            <div class="col-span-3">{{ memberDetail?.points_expire_at }}</div>
          </div>

          <!-- 最後活動時間 -->
          <div class="grid grid-cols-4 gap-4">
            <div class="text-gray-600 dark:text-gray-400">最後活動時間</div>
            <div class="col-span-3">{{ memberDetail?.last_activity_at }}</div>
          </div>
        </div>
      </UCard>
    </div>
  </div>
</template>