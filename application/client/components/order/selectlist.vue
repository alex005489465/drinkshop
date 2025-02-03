<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { storeToRefs } from 'pinia';
import type { Product } from '~/stores/order';
import { useOrderStore } from '~/stores/order';

/**
 * 初始化 order store
 * Initialize order store
 */
const orderStore = useOrderStore();

/**
 * 解構 store 狀態
 * Destructure store state
 */
const { productList, currentCategory } = storeToRefs(orderStore);

/**
 * 根據分類篩選產品
 * Filter products by category
 */
const filteredProducts = computed(() => {
  if (currentCategory.value.id === 0) return productList.value;
  return productList.value.filter(p => p.category.id === currentCategory.value.id);
});
</script>

<template>
  <div class="space-y-6">
    

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