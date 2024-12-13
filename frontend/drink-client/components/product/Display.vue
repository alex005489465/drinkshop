<script setup>
import { useProductStore } from '@/stores/productStore';
import { computed } from 'vue';

const productStore = useProductStore();

// Get product details through `selectedProduct`
const product = computed(() => productStore.selectedProductDetails);

// Display default product information if `product` is not found
const defaultProduct = {
  id: 0,
  name: 'Product Not Found',
  description: 'Please select a product from the list.',
  price: 0,
  category: 'none',
  image_url: '',
  created_at: new Date().toISOString(),
  updated_at: new Date().toISOString(),
};

const currentProduct = computed(() => product.value || defaultProduct);
</script>

<template>
  <div>
    <div style="display: flex;">
      <div class="w-80 h-60 border flex items-center justify-center">
        <!-- Product Image -->
        <img :src="currentProduct.image_url" alt="Product Image" v-if="currentProduct.image_url" />
        <p v-else>Image Placeholder</p>
      </div>
      <div class="ml-5">
        <h1 class="text-2xl font-bold">{{ currentProduct.name }}</h1>
        <p>{{ currentProduct.description }}</p>
        <p class="text-lg">Price: ${{ currentProduct.price }}</p>
        <p class="text-lg">Category: {{ currentProduct.category }}</p>
        <p class="text-sm text-gray-500">Created At: {{ new Date(currentProduct.created_at).toLocaleString() }}</p>
        <p class="text-sm text-gray-500">Updated At: {{ new Date(currentProduct.updated_at).toLocaleString() }}</p>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
