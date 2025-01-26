<script setup lang="ts">
import { useProductStore } from '~/stores/product';
import { storeToRefs } from 'pinia';

const productStore = useProductStore();
const { selectedDrink } = storeToRefs(productStore);
</script>

<template>
  <div>
    <!-- 這裡是產品描述的內容 -->
    <p v-if="selectedDrink">飲料ID: {{ selectedDrink.id }}</p>
    <p v-if="selectedDrink">飲料名稱: {{ selectedDrink.name }}</p>
    <p v-else>請選擇一個飲料</p>
  </div>
</template>

<style scoped>
/* 根據需要添加樣式 */
</style>
