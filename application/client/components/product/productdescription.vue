<script setup lang="ts">
// 導入相關函數和組件
import { useProductStore } from '~/stores/product';
import { storeToRefs } from 'pinia';

// 初始化 store
const productStore = useProductStore();
// 從 store 中解構需要的響應式屬性
// getDrinkById: 獲取當前選中飲料的詳細信息
const { getDrinkById } = storeToRefs(productStore);
</script>

<template>
  <!-- 飲料詳細信息容器 -->
  <div class="drink-details">
    <!-- 當有選中的飲料時顯示詳細信息 -->
    <div v-if="getDrinkById" class="p-4">
      <!-- 飲料名稱 -->
      <h2 class="text-xl font-bold mb-4">{{ getDrinkById.name }}</h2>
      
      <!-- 飲料圖片 -->
      <div class="mb-6 aspect-square w-[150px] bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden">
        <img 
          src="https://placehold.co/150x150/png" 
          :alt="getDrinkById.name"
          class="w-full h-full object-cover"
        >
      </div>

      <!-- 飲料詳細信息列表 -->
      <div class="space-y-4">
        <!-- 飲料描述 -->
        <p class="description">
          <span class="font-medium">描述：</span>
          {{ getDrinkById.description }}
        </p>
        <!-- 飲料熱量 -->
        <p class="calories">
          <span class="font-medium">熱量：</span>
          {{ getDrinkById.calories }}
        </p>
        <!-- 飲料成分 -->
        <p class="elements">
          <span class="font-medium">成分：</span>
          {{ getDrinkById.elements }}
        </p>
      </div>
    </div>
    <!-- 未選中飲料時顯示提示信息 -->
    <div v-else class="p-4">
      <p>請選擇一種飲料以查看詳細信息。</p>
    </div>
  </div>
</template>

<style scoped>
/* 飲料詳細信息卡片樣式 */
.drink-details {
  @apply bg-white dark:bg-gray-800 rounded-lg shadow;
}
</style>