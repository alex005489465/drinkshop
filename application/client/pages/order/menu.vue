<script setup lang="ts">
/**
 * 定義頁面元數據
 * Define page metadata
 */
definePageMeta({
  
});

/**
 * 導入組件
 * Import components
 */
import SelectList from '~/components/order/selectlist.vue';

/**
 * 處理產品選擇事件
 * Handle product selection event
 * @param product - 選擇的產品 Selected product
 */
const handleProductSelect = (product: any) => {
  console.log('Selected product:', product);
};
</script>

<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- 頁面標題 Page title -->
      <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">飲品訂購</h1>
      </div>

      <!-- 產品列表區域 Product list area -->
      <div class="grid grid-cols-5 gap-6">
        <!-- 左側產品列表 (80%) Left side product list (80%) -->
        <div class="col-span-4 min-w-[600px] bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <SelectList @select-product="handleProductSelect" />
        </div>

        <!-- 右側購物車資訊 (20%) -->
        <div class="col-span-1 min-w-[200px] bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <h2 class="text-xl font-semibold mb-4">購物車</h2>
          <div class="text-gray-600 dark:text-gray-400">
            這裡是購物車的內容...
          </div>
        </div>
      </div>
    </div>
  </div>
</template>