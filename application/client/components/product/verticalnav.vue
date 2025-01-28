<script setup lang="ts">
import { computed } from 'vue';
import { useProductStore } from '~/stores/product';
import { storeToRefs } from 'pinia';

const productStore = useProductStore();
const { getDrinksBySelectedCategory, selectedDrinkId } = storeToRefs(productStore);

// 處理資料
const links = computed(() =>
  getDrinksBySelectedCategory.value.map(drink => ({
    label: drink.name,
    id: drink.id
  }))
);

const handleDrinkClick = (id: number) => {
  selectedDrinkId.value = id;
};
</script>

<template>
  <ul class="pl-4">
    <li
      v-for="link in links"
      :key="link.id"
      @click="handleDrinkClick(link.id)"
      class="cursor-pointer py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md transition-colors duration-200"
    >
      {{ link.label }}
    </li>
  </ul>
</template>

<style scoped>
.pl-4 {
  padding-left: 1rem;
}

.cursor-pointer {
  cursor: pointer;
}

.py-2 {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.px-4 {
  padding-left: 1rem;
  padding-right: 1rem;
}

.hover\:bg-gray-100:hover {
  background-color: #f7fafc;
}

.dark\:hover\:bg-gray-700:hover {
  background-color: #374151;
}

.rounded-md {
  border-radius: 0.375rem;
}

.transition-colors {
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
}

.duration-200 {
  transition-duration: 200ms;
}
</style>