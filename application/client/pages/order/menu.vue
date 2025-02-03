<script setup lang="ts">
/**
 * 飲品訂購頁面
 * Drink ordering page
 */

/**
 * 導入相關組件和工具
 * Import components and utilities
 */
import { ref, onMounted } from 'vue';
import { storeToRefs } from 'pinia';
import SelectList from '~/components/order/selectlist.vue';
import SelectCategories from '~/components/order/selectcategories.vue';
import OrderSideover from '~/components/order/ordersideover.vue';
import { useStoreproduct } from '~/composables/storeproduct';
import { useStoreorder } from '~/composables/storeorder';
import { useOrderStore } from '~/stores/order';

/**
 * 定義類型
 * Type definitions
 */
type SlideoverSide = 'left' | 'right' | 'bottom' | 'top';

/**
 * 側邊欄狀態管理
 * Slideover state management
 */
const isSlideoverOpen = ref(false);
const slideoverSide = ref<SlideoverSide>('left');

/**
 * Store初始化
 * Store initialization
 */
const orderStore = useOrderStore();
const { selectedProduct } = storeToRefs(orderStore);

/**
 * API方法導入
 * API methods import
 */
const { fetchCategoriesFromBackend } = useStoreproduct();
const { fetchProductsFromBackend, fetchOrderItemsFromBackend } = useStoreorder();

onMounted(async () => {
  try {
    await Promise.all([
      fetchCategoriesFromBackend(),
      fetchProductsFromBackend(),
      fetchOrderItemsFromBackend()
    ]);
  } catch (error) {
    console.error('Failed to fetch data:', error);
  }
});

/**
 * 處理產品選擇事件：打開 Slideover
 * Handle product selection: Open Slideover
 */
const handleProductSelect = (product: Product) => {
  selectedProduct.value = product;
  slideoverSide.value = 'right';
  isSlideoverOpen.value = true;
};
</script>

<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- 固定頁面標題 Fixed page title -->
    <div class="fixed left-0 right-0 top-[80px] z-[5] bg-gray-50 dark:bg-gray-900 shadow-md">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <SelectCategories />
      </div>
    </div>

    <!-- 主要內容區 Main content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-[120px]">
      <SelectList @select-product="handleProductSelect" />

      <USlideover 
        v-model="isSlideoverOpen" 
        :side="slideoverSide"
        :overlay="false"
      >
        <OrderSideover 
          v-if="selectedProduct"
          @submit="isSlideoverOpen = false"
        />
      </USlideover>
    </div>
  </div>
</template>