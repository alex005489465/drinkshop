<script setup lang="ts">
/**
 * 訂單側邊欄組件
 * Order Sideover Component
 */

/**
 * 導入相關組件和工具
 * Import components and utilities
 */
import { ref, computed } from 'vue';
import { storeToRefs } from 'pinia';
import { useOrderStore } from '~/stores/order';
import { useCartStore } from '~/stores/cart';

/**
 * 杯型選項類型定義
 * Size option type definition
 */
type SizeOption = 'small' | 'medium' | 'large' | 'X_Large';

/**
 * 可選杯型列表
 * Available size options
 */
const sizeOptions = ['small', 'medium', 'large', 'X_Large'] as const;

/**
 * Store實例化
 * Store initialization
 */
const orderStore = useOrderStore();
const cartStore = useCartStore();
const { selectedOrderItem } = storeToRefs(orderStore);

/**
 * 表單數據
 * Form data
 */
const selectedSize = ref<'small' | 'medium' | 'large' | 'X_Large'>('medium');  // 選擇的杯型 Selected size
const selectedSugar = ref(5);    // 糖度選擇 Sugar level selection
const selectedIce = ref(5);      // 冰塊選擇 Ice level selection
const selectedToppings = ref<number[]>([]);  // 已選配料 Selected toppings
const quantity = ref(1);         // 訂購數量 Order quantity
const note = ref('');  // 備註 Note

/**
 * 價格計算相關
 * Price calculation
 */
const basePrice = computed(() => 
  selectedOrderItem.value?.sizes[selectedSize.value] || 0
);

const toppingsPrice = computed(() => {
  if (!selectedOrderItem.value) return 0;
  return selectedToppings.value.reduce((total, id) => {
    const topping = selectedOrderItem.value?.toppings.find(t => t.id === id);
    return total + (topping?.price || 0);
  }, 0);
});

const price = computed(() => basePrice.value + toppingsPrice.value);
const subtotal = computed(() => price.value * quantity.value);

/**
 * 數量控制相關
 * Quantity controls
 */
const increaseQuantity = () => quantity.value++;
const decreaseQuantity = () => {
  if (quantity.value > 1) quantity.value--;
};

/**
 * 生成唯一ID
 * Generate unique ID
 */
const generateUniqueId = (): number => {
  const min = 0;
  const max = 999999; // 可調整範圍 Adjustable range
  let id: number;
  
  do {
    id = Math.floor(Math.random() * (max - min + 1)) + min;
  } while (id in cartStore.cartItems);
  
  return id;
};

/**
 * 提交處理函數
 * Submit handler
 */
const emit = defineEmits(['submit']);

const handleSubmit = () => {
  if (!selectedOrderItem.value) return;
  
  const id = generateUniqueId();
  cartStore.cartItems[id] = {
    drinkId: selectedOrderItem.value.id,
    drinkName: selectedOrderItem.value.name,
    size: {
      type: selectedSize.value,
      price: basePrice.value
    },
    sugar: selectedSugar.value,
    ice: selectedIce.value,
    toppings: selectedToppings.value.map(id => {
      const topping = selectedOrderItem.value!.toppings.find(t => t.id === id)!;
      return {
        id: topping.id,
        name: topping.name,
        price: topping.price
      };
    }),
    price: price.value,
    quantity: quantity.value,
    subtotal: subtotal.value,
    note: note.value || undefined
  };
  emit('submit');
};
</script>

<template>
  <div class="h-screen flex flex-col">
    <!-- Fixed Header -->
    <div class="p-4 border-b">
      <h2 class="text-xl font-bold">{{ selectedOrderItem?.name }}</h2>
    </div>

    <!-- Scrollable Content -->
    <div class="flex-1 overflow-y-auto p-4">
      <form @submit.prevent="handleSubmit" v-if="selectedOrderItem" class="space-y-6">
        <!-- 杯型選擇 Size Selection -->
        <div class="space-y-2">
          <label class="font-medium">杯型選擇</label>
          <div class="flex flex-col space-y-2">
            <template v-for="size in sizeOptions" :key="size">
              <div class="flex items-center">
                <input type="radio" 
                       :id="size" 
                       :value="size" 
                       v-model="selectedSize" 
                       name="size"
                       class="mr-2">
                <label :for="size">
                  {{ size }} (${{ selectedOrderItem.sizes[size as SizeOption] }})
                </label>
              </div>
            </template>
          </div>
        </div>

        <!-- 糖度冰塊 Sugar & Ice -->
        <div class="flex flex-col space-y-4">
          <div class="space-y-2">
            <label class="font-medium">糖度</label>
            <select v-model="selectedSugar" class="w-full border border-gray-300 rounded-md p-2">
              <option value="0">無糖</option>
              <option value="1">微糖</option>
              <option value="2">半糖</option>
              <option value="3">七分糖</option>
              <option value="4">正常糖</option>
            </select>
          </div>
          <div class="space-y-2">
            <label class="font-medium">冰塊</label>
            <select v-model="selectedIce" class="w-full border border-gray-300 rounded-md p-2">
              <option value="0">去冰</option>
              <option value="1">微冰</option>
              <option value="2">半冰</option>
              <option value="3">少冰</option>
              <option value="4">正常冰</option>
            </select>
          </div>
        </div>

        <!-- 配料選擇 Toppings -->
        <div class="space-y-2">
          <label class="font-medium">配料</label>
          <div class="space-y-2">
            <div v-for="topping in selectedOrderItem.toppings" :key="topping.id" class="flex items-center">
              <input type="checkbox" 
                     :id="`topping-${topping.id}`" 
                     :value="topping.id" 
                     v-model="selectedToppings">
              <label :for="`topping-${topping.id}`" class="ml-2">
                {{ topping.name }} (+${{ topping.price }})
              </label>
            </div>
          </div>
        </div>

        <!-- 數量與價格 Quantity & Price -->
        <div class="flex flex-col space-y-4">
          <div>
            <label class="font-medium">數量:</label>
            <div class="flex items-center border rounded mt-2 w-32">
              <button type="button" @click="decreaseQuantity" class="px-3 py-1 hover:bg-gray-100 w-10">-</button>
              <span class="flex-1 text-center border-x">{{ quantity }}</span>
              <button type="button" @click="increaseQuantity" class="px-3 py-1 hover:bg-gray-100 w-10">+</button>
            </div>
          </div>
          <div class="space-y-2">
            <div>單價: ${{ price }}</div>
            <div class="font-bold">小計: ${{ subtotal }}</div>
          </div>
        </div>

        <!-- 備註 Note -->
        <div class="space-y-2">
          <label class="font-medium">備註</label>
          <textarea 
            v-model="note"
            rows="2"
            placeholder="有什麼特別要求嗎？"
            class="w-full border border-gray-300 rounded-md p-2"
          ></textarea>
        </div>
      </form>
    </div>

    <!-- Fixed Footer -->
    <div class="p-4 border-t">
      <UButton type="submit" color="primary" @click="handleSubmit">
        加入購物車
      </UButton>
    </div>
  </div>
</template>