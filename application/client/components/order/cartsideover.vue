<script setup lang="ts">
import { ref } from 'vue';
import { storeToRefs } from 'pinia';
import { useCartStore } from '~/stores/cart';
import type { CartItem } from '~/stores/cart';

type SizeOption = 'small' | 'medium' | 'large' | 'X_Large';
const sizeOptions = ['small', 'medium', 'large', 'X_Large'] as const;

const cartStore = useCartStore();
const { selectedEditItem, cartItems, currentDisplay, currentItem } = storeToRefs(cartStore);

// Edit form data
const editedSize = ref<SizeOption>(currentItem.value?.size.type || 'medium');
const editedToppings = ref<number[]>(currentItem.value?.toppings?.map(t => t.id) || []);
const editedSugar = ref(currentItem.value?.sugar ?? 5);
const editedIce = ref(currentItem.value?.ice ?? 5);
const editedQuantity = ref(currentItem.value?.quantity ?? 1);
const editedNote = ref(currentItem.value?.note ?? '');

// Update cart item
const handleUpdate = () => {
  if (!selectedEditItem.value || !currentItem.value || !currentDisplay.value) return;

  const selectedToppings = currentDisplay.value.toppings
    .filter(t => editedToppings.value.includes(t.id))
    .map(t => ({
      id: t.id,
      name: t.name,
      price: t.price
    }));

  const basePrice = currentDisplay.value.sizes[editedSize.value];
  const toppingsPrice = selectedToppings.reduce((sum, t) => sum + t.price, 0);
  const newPrice = basePrice + toppingsPrice;
  const newSubtotal = newPrice * editedQuantity.value;

  cartItems.value[selectedEditItem.value.index] = {
    ...currentItem.value,
    size: {
      type: editedSize.value,
      price: basePrice
    },
    toppings: selectedToppings,
    sugar: editedSugar.value,
    ice: editedIce.value,
    quantity: editedQuantity.value,
    price: newPrice,
    subtotal: newSubtotal,
    note: editedNote.value || undefined
  };

  selectedEditItem.value = null;
  emit('update');
};

const emit = defineEmits(['update', 'cancel']);
</script>

<template>
  <div class="h-screen flex flex-col">
    <!-- Header -->
    <div class="p-4 border-b">
      <h2 class="text-xl font-bold">{{ currentDisplay?.name }}</h2>
    </div>

    <!-- Content -->
    <div class="flex-1 overflow-y-auto p-4">
      <form @submit.prevent="handleUpdate" v-if="currentDisplay && currentItem" class="space-y-6">
        <!-- Size -->
        <div class="space-y-2">
          <label class="font-medium">杯型選擇</label>
          <div class="flex flex-col space-y-2">
            <template v-for="size in sizeOptions" :key="size">
              <div class="flex items-center">
                <input 
                  type="radio"
                  :id="size"
                  :value="size"
                  v-model="editedSize"
                  name="size"
                  class="mr-2"
                >
                <label :for="size">
                  {{ size }} (${{ currentDisplay?.sizes[size as SizeOption] }})
                </label>
              </div>
            </template>
          </div>
        </div>

        <!-- Toppings -->
        <div v-if="currentDisplay?.toppings.length" class="space-y-2">
          <label class="font-medium">配料</label>
          <div class="space-y-2">
            <div v-for="topping in currentDisplay.toppings" :key="topping.id" class="flex items-center">
              <input 
                type="checkbox"
                :id="`topping-${topping.id}`"
                :value="topping.id"
                v-model="editedToppings"
                class="mr-2"
              >
              <label :for="`topping-${topping.id}`">
                {{ topping.name }} (+${{ topping.price }})
              </label>
            </div>
          </div>
        </div>

        <!-- Sugar & Ice Controls -->
        <div class="space-y-4">
          <div class="space-y-2">
            <label class="font-medium">糖度</label>
            <select v-model="editedSugar" class="w-full border rounded-md p-2">
              <option value="0">無糖</option>
              <option value="1">微糖</option>
              <option value="2">半糖</option>
              <option value="3">七分糖</option>
              <option value="4">正常糖</option>
            </select>
          </div>
          <div class="space-y-2">
            <label class="font-medium">冰塊</label>
            <select v-model="editedIce" class="w-full border rounded-md p-2">
              <option value="0">去冰</option>
              <option value="1">微冰</option>
              <option value="2">半冰</option>
              <option value="3">少冰</option>
              <option value="4">正常冰</option>
            </select>
          </div>
        </div>

        <!-- Quantity -->
        <div class="space-y-2">
          <label class="font-medium">數量</label>
          <div class="flex items-center border rounded w-32">
            <button type="button" @click="editedQuantity > 1 ? editedQuantity-- : null" class="px-3 py-1">-</button>
            <span class="flex-1 text-center border-x">{{ editedQuantity }}</span>
            <button type="button" @click="editedQuantity++" class="px-3 py-1">+</button>
          </div>
        </div>

        <!-- Note -->
        <div class="space-y-2">
          <label class="font-medium">備註</label>
          <textarea 
            v-model="editedNote"
            rows="2"
            class="w-full border rounded-md p-2"
            placeholder="有什麼特別要求嗎？"
          ></textarea>
        </div>

        <!-- Price Info -->
        <div class="space-y-1">
          <div>單價: ${{ currentItem.price }}</div>
          <div class="font-bold">小計: ${{ currentItem.price * editedQuantity }}</div>
        </div>
      </form>
    </div>

    <!-- Footer -->
    <div class="p-4 border-t">
      <div class="space-y-2">
        <UButton block color="primary" @click="handleUpdate">儲存變更</UButton>
        <UButton block color="gray" variant="soft" @click="selectedEditItem = null">取消</UButton>
      </div>
    </div>
  </div>
</template>