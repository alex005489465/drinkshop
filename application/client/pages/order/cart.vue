<script setup lang="ts">
definePageMeta({
  middleware: ['auth']
});

import { ref, watch } from 'vue';
import { storeToRefs } from 'pinia';
import { useCartStore } from '~/stores/cart';
import { useStorecart } from '~/composables/storecart';
import CartList from '~/components/order/cartlist.vue';
import CartSideover from '~/components/order/cartsideover.vue';

const cartStore = useCartStore();
const { cartItems, total, totalQuantity } = storeToRefs(cartStore);
const { saveCartItemsToBackend } = useStorecart();

const isSlideoverOpen = ref(false);

const handleModify = () => {
  isSlideoverOpen.value = true;
};

/**
 * 監視購物車項目變化
 * Watch cartItems changes
 */
watch(cartItems, async () => {
  try {
    await saveCartItemsToBackend();
  } catch (error) {
    console.error('Failed to save cart items:', error);
  }
}, { deep: true });
</script>

<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- 購物車標題 Cart title -->
      <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">購物車</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">
          共 {{ totalQuantity }} 件商品，總計 ${{ total }}
        </p>
      </div>

      <!-- 購物車列表 Cart list -->
      <CartList @modify="handleModify" />

      <!-- Slideover -->
      <USlideover 
        v-model="isSlideoverOpen"
        side="left"
      >
        <CartSideover 
          @update="isSlideoverOpen = false"
          @cancel="isSlideoverOpen = false"
        />
      </USlideover>
    </div>
  </div>
</template>