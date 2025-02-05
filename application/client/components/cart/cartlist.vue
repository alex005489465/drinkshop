<script setup lang="ts">
/**
 * 購物車列表組件
 * Cart List Component
 */

import { storeToRefs } from 'pinia';
import { useCartStore } from '~/stores/cart';
import { defineEmits } from 'vue';
import { useStoreorder } from '~/composables/storeorder';
import { navigateTo } from '#imports';

const emit = defineEmits(['modify', 'submit']);
const cartStore = useCartStore();
const { cartItems, selectedEditItem, total } = storeToRefs(cartStore);
const { submitOrderToBackend } = useStoreorder();

type SugarLevel = 0 | 1 | 2 | 3 | 4;
type IceLevel = 0 | 1 | 2 | 3 | 4;

const sugarLevels: Record<SugarLevel, string> = {
  0: '無糖',
  1: '微糖',
  2: '半糖',
  3: '七分糖',
  4: '正常糖'
};

const iceLevels: Record<IceLevel, string> = {
  0: '去冰',
  1: '微冰',
  2: '半冰',
  3: '少冰',
  4: '正常冰'
};

const getSugarText = (level: number): string => {
  return sugarLevels[level as SugarLevel] || '正常糖';
};

const getIceText = (level: number): string => {
  return iceLevels[level as IceLevel] || '正常冰';
};

const handleModify = (index: number) => {
  selectedEditItem.value = { 
    index,
    drinkId: cartItems.value[index].drinkId
  };
  emit('modify');
};

const handleDelete = (index: number) => {
  delete cartItems.value[index];
};

const handleSubmit = async () => {
  try {
    await submitOrderToBackend();
    cartItems.value = {};  // Clear cart after successful order
    navigateTo('/');
  } catch (error) {
    console.error('訂單送出失敗:', error);
  }
};

const handleClear = () => {
  cartItems.value = {};
};
</script>

<template>
  <!-- Cart List -->
  <div v-if="Object.keys(cartItems).length > 0" class="space-y-4">
    <div v-for="[index, item] in Object.entries(cartItems)" :key="item.drinkId" 
         class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
      <div class="flex justify-between items-start">
        <!-- 商品資訊 Product info -->
        <div class="space-y-2">
          <h3 class="text-lg font-medium">{{ item.drinkName }}</h3>
          <p class="text-sm text-gray-500">
            {{ item.size.type }} / 
            糖度: {{ getSugarText(item.sugar) }} / 
            冰塊: {{ getIceText(item.ice) }}
          </p>
          <!-- 配料 Toppings -->
          <div v-if="item.toppings?.length" class="text-sm text-gray-500">
            配料: {{ item.toppings.map(t => t.name).join(', ') }}
          </div>
          <!-- 備註 Note -->
          <div v-if="item.note" class="text-sm text-gray-500">
            備註: {{ item.note }}
          </div>
        </div>
        <!-- 價格資訊與按鈕 Price info and buttons -->
        <div class="text-right space-y-4">
          <div>
            <div class="text-sm text-gray-500">單價: ${{ item.price }}</div>
            <div class="text-sm text-gray-500">數量: {{ item.quantity }}</div>
            <div class="font-medium">小計: ${{ item.subtotal }}</div>
          </div>
          <div class="space-x-2">
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
  <div v-else class="text-center text-gray-500">
    購物車是空的
  </div>

  <!-- 底部操作區 Bottom actions -->
  <div v-if="Object.keys(cartItems).length > 0" class="mt-8 flex justify-end space-x-4 items-center">
    <div class="text-xl font-bold">
      總計: ${{ total }}
    </div>
    <UButton
      color="primary"
      @click="handleSubmit"
    >
      送出訂單
    </UButton>
    <UButton
      color="gray"
      variant="soft"
      @click="handleClear"
    >
      清空購物車
    </UButton>
  </div>
</template>