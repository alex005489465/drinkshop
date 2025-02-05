<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { storeToRefs } from 'pinia';
import { useOrderStore } from '~/stores/order';
import { useStoreorder } from '~/composables/storeorder';

const orderStore = useOrderStore();
const { orders, selectedOrderNumber, orderDetail } = storeToRefs(orderStore);
const { fetchOrderListFromBackend, fetchOrderDetailFromBackend } = useStoreorder();
const expandedOrder = ref<string | null>(null);

onMounted(async () => {
  try {
    await fetchOrderListFromBackend();
  } catch (error) {
    console.error('Failed to fetch orders:', error);
  }
});

const handleOrderClick = async (orderNumber: string) => {
  orderStore.orderDetail = null;  // Clear previous detail
  expandedOrder.value = expandedOrder.value === orderNumber ? null : orderNumber;
  selectedOrderNumber.value = expandedOrder.value;  // Use empty string instead of null
  
  if (expandedOrder.value) {  // Only fetch if expanding
    try {
      await fetchOrderDetailFromBackend(orderNumber);
    } catch (error) {
      console.error('Failed to fetch order detail:', error);
    }
  }
};
</script>

<template>
  <div class="space-y-6">
    <div 
      v-for="order in orders" 
      :key="order.order_number" 
      class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200"
    >
      <!-- Order Header -->
      <div 
        @click="handleOrderClick(order.order_number)"
        class="p-6 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 flex justify-between items-center rounded-t-xl"
      >
        <div class="space-y-1">
          <div class="text-sm text-gray-500 dark:text-gray-400">訂單編號</div>
          <div class="font-medium text-gray-900 dark:text-white">{{ order.order_number }}</div>
        </div>
        <div class="text-right space-y-2">
          <div class="text-lg font-semibold text-gray-900 dark:text-white">
            ${{ order.total_amount }}
          </div>
          <div class="text-sm text-gray-500">{{ order.created_at }}</div>
          <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
               :class="{
                 'bg-yellow-100 text-yellow-800': order.status === 'pending',
                 'bg-blue-100 text-blue-800': order.status === 'processing',
                 'bg-green-100 text-green-800': order.status === 'completed',
                 'bg-red-100 text-red-800': order.status === 'cancelled'
               }">
            {{ order.status }}
          </div>
        </div>
      </div>

      <!-- Order Details -->
      <div 
        v-show="expandedOrder === order.order_number"
        class="border-t border-gray-200 dark:border-gray-700"
      >
        <div class="p-6" v-if="selectedOrderNumber === order.order_number && orderDetail">
          <div 
            v-for="item in orderDetail.items" 
            :key="item.product_id" 
            class="py-4 first:pt-0 last:pb-0 border-b last:border-0 dark:border-gray-700"
          >
            <div class="flex justify-between items-start">
              <div class="space-y-2">
                <div class="text-lg font-medium text-gray-900 dark:text-white">
                  {{ item.size }}
                </div>
                <div v-if="item.ingredients.length" class="text-sm text-gray-600 dark:text-gray-400">
                  配料: {{ item.ingredients.join('、') }}
                </div>
                <div v-if="item.notes" class="text-sm text-gray-500 italic">
                  備註: {{ item.notes }}
                </div>
              </div>
              <div class="text-right space-y-2">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                  ${{ item.unit_price }}
                  <span class="mx-1">×</span>
                  {{ item.quantity }}
                </div>
                <div class="text-base font-semibold text-gray-900 dark:text-white border-t pt-2 dark:border-gray-700">
                  小計: ${{ item.total_price }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>