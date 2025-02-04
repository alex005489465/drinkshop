<script setup lang="ts">
import { onMounted } from 'vue';
import CategoryList from '~/components/product/categorylist.vue';
import ProductDescription from '~/components/product/productdescription.vue';
import { useStoreproduct } from '~/composables/storeproduct';

const { fetchCategoriesFromBackend, fetchDrinkDetails } = useStoreproduct();

onMounted(async () => {
  try {
    await Promise.all([
      fetchCategoriesFromBackend(),
      fetchDrinkDetails()
    ]);
  } catch (error) {
    console.error('Failed to fetch initial data:', error);
  }
});
</script>

<template>
  <div class="flex">
    <!-- 左側類別列表 -->
    <div class="left-pane w-1/3 p-4 border-r">
      <CategoryList />
    </div>
    <!-- 右側產品描述 -->
    <div class="right-pane w-2/3 p-4">
      <ProductDescription />
    </div>
  </div>
</template>

<style scoped>
.flex {
  @apply min-h-screen bg-white dark:bg-gray-900;
}

.left-pane {
  @apply bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700;
}

.right-pane {
  @apply bg-gray-50 dark:bg-gray-800;
}
</style>
