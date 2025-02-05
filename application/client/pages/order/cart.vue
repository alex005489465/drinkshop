<script setup lang="ts">

import { ref, watch } from 'vue';
import { storeToRefs } from 'pinia';
import { useCartStore } from '~/stores/cart';
import { useAuthStore } from '~/stores/auth';
import { useStorecart } from '~/composables/storecart';
import CartList from '~/components/cart/cartlist.vue';
import CartSideover from '~/components/cart/cartsideover.vue';

const cartStore = useCartStore();
const authStore = useAuthStore();
const { cartItems, total, totalQuantity } = storeToRefs(cartStore);
const { isAuthenticated } = storeToRefs(authStore);
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
      <h1 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-8">
        購物車
      </h1>

      <div v-if="!isAuthenticated" class="text-center text-gray-600 dark:text-gray-400">
        需登入後才能查看購物車內容
      </div>

      <div v-else>
        <div class="text-center mb-12">
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
  </div>
</template>