<script setup lang="ts">
import { storeToRefs } from 'pinia';
import { useAuthStore } from '~/stores/auth';
import OrderList from '~/components/order/orderlist.vue';

const authStore = useAuthStore();
const { isAuthenticated } = storeToRefs(authStore);
</script>

<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-8">
        訂單紀錄
      </h1>

      <div v-if="!isAuthenticated" class="text-center text-gray-600 dark:text-gray-400">
        需登入後才能查看訂單紀錄
      </div>

      <div v-else>
        <OrderList />
      </div>
    </div>
  </div>
</template>