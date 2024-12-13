<script setup lang="ts">
import { computed } from 'vue';
import { useCategoryStore } from '@/stores/categoryStore';

const categoryStore = useCategoryStore();

const categories = computed(() => categoryStore.categories);
const selectedProduct = computed(() => categoryStore.selectedProduct);

function toggleCategory(category) {
  categoryStore.toggleCategory(category);
}

function selectProduct(productId) {
  categoryStore.selectProduct(productId);
}
</script>

<template>
  <div>
      <ul>
        <li v-for="category in categories" :key="category.name" class="mb-4">
          <h2 class="text-lg font-semibold cursor-pointer" @click="toggleCategory(category)">
            {{ category.name }}
          </h2>
          <ul v-show="category.isOpen" class="list-disc list-inside">
            <li v-for="drink in category.drinks" :key="drink.productId">
              <a href="#" @click.prevent="selectProduct(drink.productId)">
                {{ drink.name }}
              </a>
            </li>
          </ul>
        </li>
      </ul>
  </div>
</template>

<style scoped>
/* Add your custom styles here */
</style>
