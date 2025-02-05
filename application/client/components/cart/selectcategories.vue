<script setup lang="ts">
import { storeToRefs } from 'pinia';
import { useCartStore } from '~/stores/cart';

const CartStore = useCartStore();
const { categoryList, currentCategory } = storeToRefs(CartStore);
</script>

<template>
  <!-- 分類標籤 Category tags -->
  <div class="flex space-x-4 mt-6 mb-6">
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
</template>