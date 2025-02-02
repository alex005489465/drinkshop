<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { storeToRefs } from 'pinia';
import type { Product } from '~/stores/order';
import { useOrderStore } from '~/stores/order';
import { useStoreproduct } from '~/composables/storeproduct';
import { useStoreorder } from '~/composables/storeorder';

/**
 * 初始化 order store
 * Initialize order store
 */
const orderStore = useOrderStore();

/**
 * 解構 store 狀態
 * Destructure store state
 */
const { categoryList, productList } = storeToRefs(orderStore);
const { fetchCategoriesFromBackend } = useStoreproduct();
const { fetchProductsFromBackend } = useStoreorder();

/**
 * 當前選擇的分類
 * Currently selected category
 */
const currentCategory = ref(categoryList.value[0]);

/**
 * 在組件掛載時獲取數據
 * Fetch data when component is mounted
 */
onMounted(async () => {
  try {
    await Promise.all([
      fetchCategoriesFromBackend(),
      fetchProductsFromBackend()
    ]);
  } catch (error) {
    console.error('Failed to fetch data:', error);
  }
});

// 根據分類篩選產品
const filteredProducts = computed(() => {
  if (currentCategory.value.id === 0) return productList.value;
  return productList.value.filter(p => p.category.id === currentCategory.value.id);
});
</script>

<template>
  <div class="space-y-6">
    <!-- 分類標籤 -->
    <div class="flex space-x-4 mb-6">
      <UButton
        v-for="category in categoryList"
        :key="category.id"
        :color="currentCategory === category ? 'primary' : 'gray'"
        :variant="currentCategory === category ? 'solid' : 'soft'"
        @click="currentCategory = category"
      >
        {{ category.name }}
      </UButton>
    </div>

    <!-- 產品網格 -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <UCard
        v-for="product in filteredProducts"
        :key="product.id"
        class="hover:shadow-lg transition-shadow duration-200"
      >
        <!-- 產品圖片 -->
        <img
          :src="product.image || '/images/default-product.jpg'"
          :alt="product.name"
          class="w-full h-48 object-cover rounded-t-lg"
        >
        
        <!-- 產品資訊 -->
        <div class="p-4 space-y-4">
          <h3 class="text-lg font-semibold">{{ product.name }}</h3>
          <p class="text-gray-600 dark:text-gray-400">
            NT$ {{ product.price }} 起
          </p>
          <UButton
            color="primary"
            block
            @click="$emit('select-product', product)"
          >
            選擇
          </UButton>
        </div>
      </UCard>
    </div>
  </div>
</template>