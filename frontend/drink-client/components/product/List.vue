<script setup lang="ts">
import { onMounted, computed, reactive } from 'vue';
import { useProductlistStore } from '@/stores/api/productlistStore';

const productlistStore = useProductlistStore();

onMounted(() => {
  productlistStore.fetchProducts();
});

const categories = computed(() => productlistStore.categories.value);

// Use reactive to manage the open/close state of each category
const categoryStates = reactive({});

const toggleCategory = (categoryName) => {
  if (categoryStates[categoryName] === undefined) {
    categoryStates[categoryName] = true;
  } else {
    categoryStates[categoryName] = !categoryStates[categoryName];
  }
};
</script>

<template>
  <div>
    <h1>Product Categories</h1>
    <ul>
      <li v-for="category in categories" :key="category.name">
        <h2 @click="toggleCategory(category.name)">{{ category.name }}</h2>
        <ul v-show="categoryStates[category.name]">
          <li v-for="drink in category.drinks" :key="drink.productId">
            <h3 @click="productlistStore.selectProduct(drink.productId)">{{ drink.name }}</h3>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</template>

<style scoped>
/* Add your custom styles here */
</style>
