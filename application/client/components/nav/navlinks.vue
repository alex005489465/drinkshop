<script setup lang="ts">
// 定義導航項目的介面
interface NavItem {
  name: string;  // 導航項目顯示的名稱
  to: string;    // 導航項目的目標路由
}

// 定義導航項目列表
const navItems: NavItem[] = [
  {
    name: '首頁',
    to: '/'
  },
  {
    name: '介紹',
    to: '/product/introduction'
  },
  {
    name: '菜單',
    to: '/order/menu'
  }
];
</script>

<template>
  <!-- 導航連結容器 -->
  <div class="flex justify-start space-x-4">
    <!-- 使用 v-for 遍歷導航項目並創建連結 -->
    <NuxtLink 
      v-for="item in navItems" 
      :key="item.name"
      :to="item.to"
      class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700"
    >
      {{ item.name }}
    </NuxtLink>
  </div>
</template>