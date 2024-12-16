<script setup lang="ts">
import { computed } from 'vue';
import { useAuthStore } from '@/stores/member/authStore';
import { useRegisterStore } from '@/stores/member/registerStore';
import LoginComponent from '@/components/member/LoginComponent.vue';
import DashboardComponent from '@/components/member/DashboardComponent.vue';
import RegisterComponent from '@/components/member/RegisterComponent.vue';

const authStore = useAuthStore();
const registerStore = useRegisterStore();
const isLoggedIn = computed(() => authStore.isLoggedIn);
const isRegistered = computed(() => registerStore.isRegistered);
</script>

<template>
  <div>
    <RegisterComponent v-if="!isLoggedIn && isRegistered" />
    <LoginComponent v-if="!isLoggedIn && !isRegistered" />
    <DashboardComponent v-if="isLoggedIn && !isRegistered" />
  </div>
</template>

<style scoped>
</style>
