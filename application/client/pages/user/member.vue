<script setup lang="ts">
definePageMeta({
  middleware: ['auth']
});

import { useUserProfile } from '~/composables/userprofile';
import { useUserStore } from '~/stores/user';

const userStore = useUserStore();
const { fetchUserProfile } = useUserProfile();

// 初始化數據
await fetchUserProfile();

// 從 store 獲取用戶資料
const profile = computed(() => userStore.profile);
</script>

<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- 頁面標題與編輯按鈕 -->
      <div class="flex justify-between items-center mb-12">
        <div class="w-24"></div><!-- 用於平衡布局 -->
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">使用者資料</h1>
        <UButton 
          icon="i-heroicons-pencil-square" 
          color="gray" 
          variant="soft"
          @click="navigateTo('/user/edit')"
        >
          編輯資料
        </UButton>
      </div>

      <div class="space-y-8">
        <!-- 基本資料區塊 -->
        <UCard>
          <template #header>
            <h2 class="text-xl font-semibold">基本資料</h2>
          </template>
          <div class="space-y-4">
            <div class="grid grid-cols-4 gap-4">
              <div class="text-gray-600 dark:text-gray-400">用戶名稱</div>
              <div class="col-span-3">{{ profile?.user_name }}</div>
            </div>
            <div class="grid grid-cols-4 gap-4">
              <div class="text-gray-600 dark:text-gray-400">性別</div>
              <div class="col-span-3">{{ profile?.gender }}</div>
            </div>
            <div class="grid grid-cols-4 gap-4">
              <div class="text-gray-600 dark:text-gray-400">生日</div>
              <div class="col-span-3">{{ profile?.birthdate }}</div>
            </div>
            <div class="grid grid-cols-4 gap-4">
              <div class="text-gray-600 dark:text-gray-400">國籍</div>
              <div class="col-span-3">{{ profile?.nationality }}</div>
            </div>
            <div class="grid grid-cols-4 gap-4">
              <div class="text-gray-600 dark:text-gray-400">身分證字號</div>
              <div class="col-span-3">{{ profile?.id_number }}</div>
            </div>
          </div>
        </UCard>

        <!-- 聯絡資訊區塊 -->
        <UCard>
          <template #header>
            <h2 class="text-xl font-semibold">聯絡資訊</h2>
          </template>
          <div class="space-y-4">
            <div class="grid grid-cols-4 gap-4">
              <div class="text-gray-600 dark:text-gray-400">主要電子郵件</div>
              <div class="col-span-3">{{ profile?.user_email }}</div>
            </div>
            <div class="grid grid-cols-4 gap-4">
              <div class="text-gray-600 dark:text-gray-400">備用電子郵件</div>
              <div class="col-span-3">{{ profile?.backup_email }}</div>
            </div>
            <div class="grid grid-cols-4 gap-4">
              <div class="text-gray-600 dark:text-gray-400">聯絡電話</div>
              <div class="col-span-3">{{ profile?.phone }}</div>
            </div>
          </div>
        </UCard>

        <!-- 居住資訊區塊 -->
        <UCard>
          <template #header>
            <h2 class="text-xl font-semibold">居住資訊</h2>
          </template>
          <div class="space-y-4">
            <div class="grid grid-cols-4 gap-4">
              <div class="text-gray-600 dark:text-gray-400">戶籍地址</div>
              <div class="col-span-3">{{ profile?.residential_address }}</div>
            </div>
            <div class="grid grid-cols-4 gap-4">
              <div class="text-gray-600 dark:text-gray-400">通訊地址</div>
              <div class="col-span-3">{{ profile?.mailing_address }}</div>
            </div>
          </div>
        </UCard>

        <!-- 其他資訊區塊 -->
        <UCard>
          <template #header>
            <h2 class="text-xl font-semibold">其他資訊</h2>
          </template>
          <div class="space-y-4">
            <div class="grid grid-cols-4 gap-4">
              <div class="text-gray-600 dark:text-gray-400">備註</div>
              <div class="col-span-3">{{ profile?.notes }}</div>
            </div>
          </div>
        </UCard>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
