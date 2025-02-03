<script setup lang="ts">
import { ref } from 'vue';
import { storeToRefs } from 'pinia';
import { useCartStore } from '~/stores/cart';
import type { CartItem } from '~/stores/cart';
import CartSideover from '~/components/order/cartsideover.vue';

const cartStore = useCartStore();
const { cartItems, total, totalQuantity, selectedEditItem } = storeToRefs(cartStore);

const isSlideoverOpen = ref(false);

const handleModify = (index: number) => {
  selectedEditItem.value = index;
  isSlideoverOpen.value = true;
};

const handleDelete = (index: number) => {
  delete cartItems.value[index];
};

const handleClose = () => {
  isSlideoverOpen.value = false;
};
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
      <div v-if="Object.keys(cartItems).length > 0" class="space-y-4">
        <div v-for="[index, item] in Object.entries(cartItems)" :key="item.drinkId" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <div class="flex justify-between items-start">
            <!-- 商品資訊 Product info -->
            <div class="space-y-2">
              <h3 class="text-lg font-medium">{{ item.drinkName }}</h3>
              <p class="text-sm text-gray-500">
                {{ item.size.type }} / 
                糖度: {{ item.sugar === 0 ? '無糖' : `${item.sugar}/5` }} / 
                冰塊: {{ item.ice === 0 ? '去冰' : `${item.ice}/5` }}
              </p>
              <!-- 配料 Toppings -->
              <div v-if="item.toppings && item.toppings.length > 0" class="text-sm text-gray-500">
                配料: 
                {{ item.toppings.map(t => t.name).join(', ') }}
              </div>
              <!-- 備註 Note -->
              <div v-if="item.note" class="text-sm text-gray-500">
                備註: {{ item.note }}
              </div>
            </div>
            <!-- 價格資訊 Price info -->
            <div class="text-right">
              <div class="text-sm text-gray-500">
                單價: ${{ item.price }}
              </div>
              <div class="text-sm text-gray-500">
                數量: {{ item.quantity }}
              </div>
              <div class="font-medium">
                小計: ${{ item.subtotal }}
              </div>
              <!-- 操作按鈕 Action buttons -->
              <div class="mt-4 space-x-2">
                <UButton 
                  color="primary"
                  variant="soft"
                  size="sm"
                  @click="handleModify(Number(index))"
                >
                  修改
                </UButton>
                <UButton 
                  color="red"
                  variant="soft"
                  size="sm"
                  @click="handleDelete(Number(index))"
                >
                  刪除
                </UButton>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 空購物車 Empty cart -->
      <div v-else class="text-center text-gray-500">
        購物車是空的
      </div>

      <!-- 總計 Total -->
      <div v-if="Object.keys(cartItems).length > 0" class="mt-8 text-right">
        <div class="text-xl font-bold">
          總計: ${{ total }}
        </div>
      </div>
    </div>

    <!-- Slideover -->
    <USlideover 
      v-model="isSlideoverOpen"
      side="left"
    >
      <CartSideover 
        @update="handleClose"
        @cancel="handleClose"
      />
    </USlideover>
  </div>
</template>