<script setup lang="ts">
import { ref, computed } from 'vue';
import { useProductStore } from '~/stores/product';
import { storeToRefs } from 'pinia';
import VerticalNav from './verticalnav.vue';

const productStore = useProductStore();
const { categories, selectedCategoryId } = storeToRefs(productStore);

// 控制折疊選單的開關狀態
const isVerticalNavOpen = ref(false);

// 處理類別點擊事件
// 如果點擊的是當前選中的類別，則切換折疊選單的開關狀態
// 如果點擊的是其他類別，則打開折疊選單並更新選中的類別
const handleCategoryClick = (id: number) => {
  if (selectedCategoryId.value === id) {
    isVerticalNavOpen.value = !isVerticalNavOpen.value;
  } else {
    isVerticalNavOpen.value = true;
  }
  selectedCategoryId.value = id;
};

// 將類別資料轉換為折疊選單項目格式
const accordionItems = computed(() =>
  categories.value.map((category) => ({
    id: category.id,
    label: category.name,
    icon: 'i-heroicons-cube'
  }))
);
</script>

<template>
  <div class="accordion">
    <div
      v-for="item in accordionItems"
      :key="item.id"
      class="accordion-item border-b border-gray-200 dark:border-gray-700 p-3 cursor-pointer"
    >
      <!-- 類別標題區塊，點擊時觸發handleCategoryClick -->
      <div class="flex items-center" @click="handleCategoryClick(item.id)">
        <!-- 類別圖示 -->
        <div class="w-6 h-6 rounded-full bg-primary-500 dark:bg-primary-400 flex items-center justify-center -my-1">
          <i :class="item.icon" class="w-4 h-4 text-white dark:text-gray-900"></i>
        </div>
        <!-- 類別名稱 -->
        <span class="truncate ml-3">{{ item.label }}</span>
      </div>
      <!-- 折疊內容區塊，只在選中當前類別且折疊選單開啟時顯示 -->
      <div class="pl-10">
        <VerticalNav v-if="isVerticalNavOpen && selectedCategoryId === item.id" />
      </div>
    </div>
  </div>
</template>

<style scoped>
.border-b {
  border-bottom-width: 1px;
}

.border-gray-200 {
  border-color: #e5e7eb;
}

.dark\:border-gray-700 {
  border-color: #374151;
}

.bg-primary-500 {
  background-color: #3b82f6;
}

.dark\:bg-primary-400 {
  background-color: #60a5fa;
}

.text-white {
  color: #ffffff;
}

.dark\:text-gray-900 {
  color: #111827;
}

.pl-8 {
  padding-left: 2rem;
}

.cursor-pointer {
  cursor: pointer;
}

.ml-3 {
  margin-left: 0.75rem;
}

.pl-10 {
  padding-left: 2.5rem;
}
</style>