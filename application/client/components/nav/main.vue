<script setup lang="ts">
/**
 * 主導航欄組件
 * 包含網站 Logo、導航連結和會員資訊
 */
import NavLinks from './navlinks.vue';
import MemberInfo from './memberinfo.vue';
</script>

<template>
  <!-- 主導航欄容器 -->
  <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
    <!-- 內容限寬容器 -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- 導航欄內容排列容器 -->
      <div class="flex items-center h-16 gap-8">
        <!-- Logo 區域 -->
        <div class="flex-shrink-0">
          <NuxtLink to="/">
            <img 
              src="~/assets/img/logo.png"
              alt="Drink Shop Logo"
              class="h-16 w-auto"
            />
          </NuxtLink>
        </div>
        
        <!-- 導航連結區域 -->
        <div class="flex items-center">
          <NavLinks />
        </div>

        <!-- 會員資訊區域 -->
        <div class="flex items-center ml-auto">
          <MemberInfo />
        </div>
      </div>
    </div>
  </nav>
</template>

<style scoped>
.logo {
  width: 80px; /* 可以根據需要調整寬度 */
  height: auto;
  margin-right: 20px;
}

.router-link-active {
  @apply bg-gray-100 dark:bg-gray-700;
}
</style>
