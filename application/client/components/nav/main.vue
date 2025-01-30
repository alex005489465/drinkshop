<script setup lang="ts">
const links = [
  {
    label: '首頁',
    icon: 'i-heroicons-home',
    to: '/'
  },
  {
    label: '產品',
    icon: 'i-heroicons-cube',
    to: '/product/introduction'
  },
];
</script>

<template>
  <div class="flex items-center">
    <img src="~/assets/img/logo.png" alt="Logo" class="logo" />
    <UHorizontalNavigation :links="links" class="border-b border-gray-200 dark:border-gray-800 ml-4" />
  </div>
</template>

<style scoped>
.logo {
  width: 80px; /* 可以根據需要調整寬度 */
  height: auto;
  margin-right: 20px;
}
</style>
