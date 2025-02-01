<script setup lang="ts">
import { NavMain } from '#components';
import { useAuthentication } from '~/composables/authentication';
import { useUrlStore } from '~/stores/url';
import { onMounted } from 'vue';

// 頁面配置
useHead({
  title: 'Bliss Paradise',
  meta: [
    { charset: 'utf-8' },
    { name: 'viewport', content: 'width=device-width, initial-scale=1' },
    { name: 'description', content: 'Bliss Paradise - 幸福天堂手搖飲專賣店' }
  ]
});

// 在組件掛載後檢查登入狀態與主題設定
onMounted(async () => {
  const { loginCheck } = useAuthentication();
  const urlStore = useUrlStore();
  const colorMode = useColorMode();

  // 檢查並套用主題設定
  if (urlStore.theme) {
    colorMode.preference = urlStore.theme;
  }

  // 檢查登入狀態
  try {
    await loginCheck();
  } catch (error) {
    console.error('檢查登入狀態失敗:', error);
  }
});
</script>

<template>
  <div>
    <nav class="nav-main">
      <NavMain />
    </nav>
    <div class="content">
      <NuxtPage />
    </div>
  </div>
</template>

<style scoped>
.nav-main {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background-color: #2d3748; /* Tailwind CSS class bg-gray-800 */
  color: #ffffff; /* Tailwind CSS class text-white */
  padding: 16; /* Tailwind CSS class p-4 */
  z-index: 20; /* Tailwind CSS class z-50 */
}

.content {
  padding-top: 4rem; /* Tailwind CSS class pt-16 */
}
</style>
