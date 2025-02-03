<script setup lang="ts">
import { ref, computed } from 'vue';
import { storeToRefs } from 'pinia';
import type { CartItem } from '~/stores/cart';
import { useCartStore } from '~/stores/cart';

const cartStore = useCartStore();
const { selectedEditItem, cartItems } = storeToRefs(cartStore);

// Get current editing item
const currentItem = computed(() => 
  selectedEditItem.value !== null ? cartItems.value[selectedEditItem.value] : null
);

// Edit form data
const editedSugar = ref(currentItem.value?.sugar ?? 5);
const editedIce = ref(currentItem.value?.ice ?? 5);
const editedQuantity = ref(currentItem.value?.quantity ?? 1);
const editedNote = ref(currentItem.value?.note ?? '');

// Update cart item
const emit = defineEmits(['update', 'cancel']);

const handleUpdate = () => {
  if (selectedEditItem.value === null || !currentItem.value) return;

  const newSubtotal = currentItem.value.price * editedQuantity.value;

  cartItems.value[selectedEditItem.value] = {
    ...currentItem.value,
    sugar: editedSugar.value,
    ice: editedIce.value,
    quantity: editedQuantity.value,
    subtotal: newSubtotal,
    note: editedNote.value || undefined
  };

  selectedEditItem.value = null;
  emit('update');
};

const handleCancel = () => {
  selectedEditItem.value = null;
  emit('cancel');
};
</script>

<template>
  <div class="h-screen flex flex-col">
    <!-- Fixed Header -->
    <div class="p-4 border-b">
      <h2 class="text-xl font-bold">{{ currentItem?.drinkName }}</h2>
    </div>

    <!-- Scrollable Content -->
    <div class="flex-1 overflow-y-auto p-4">
      <form @submit.prevent="handleUpdate" v-if="currentItem" class="space-y-6">
        <!-- Sugar & Ice -->
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
            <button 
              type="button" 
              class="px-3 py-1 hover:bg-gray-100" 
              @click="editedQuantity > 1 ? editedQuantity-- : null"
            >-</button>
            <span class="flex-1 text-center border-x">{{ editedQuantity }}</span>
            <button 
              type="button" 
              class="px-3 py-1 hover:bg-gray-100" 
              @click="editedQuantity++"
            >+</button>
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

    <!-- Fixed Footer -->
    <div class="p-4 border-t">
      <div class="space-y-2">
        <UButton block color="primary" @click="handleUpdate">儲存變更</UButton>
        <UButton block color="gray" variant="soft" @click="handleCancel">取消</UButton>
      </div>
    </div>
  </div>
</template>