<script setup lang="ts">
import { useProductStore } from '~/stores/product';
import { storeToRefs } from 'pinia';

const productStore = useProductStore();
const { getDrinkById } = storeToRefs(productStore);
</script>

<template>
  <div>
    <div v-if="getDrinkById">
      <h2>{{ getDrinkById.name }}</h2>
      <!-- 這裡可以添加更多飲料的詳細信息 -->
    </div>
    <div v-else>
      <p>請選擇一種飲料以查看詳細信息。</p>
    </div>
  </div>
</template>

<style scoped>
/* 根據需要添加樣式 */
</style>