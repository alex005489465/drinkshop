<script setup lang="ts">
import { useAuthStore } from '@/stores/member/authStore';

const authStore = useAuthStore();

const logout = () => {
  authStore.logout();
};
</script>

<template>
  <div>
    <h2>Welcome, Member!</h2>
    <p>This is your member dashboard.</p>
    <button @click="logout">Logout</button>
  </div>
</template>

<style scoped></style>
