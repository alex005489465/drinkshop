<script setup lang="ts">
import { ref } from 'vue';
import { useAuthStore } from '@/stores/member/authStore';
import { useRegisterStore } from '@/stores/member/registerStore';

const email = ref('');
const password = ref('');
const authStore = useAuthStore();
const registerStore = useRegisterStore();

const login = async () => {
  try {
    await authStore.login({ email: email.value, password: password.value });
  } catch (error) {
    console.error(error);
  }
};

const toggleRegister = () => {
  registerStore.toggleRegistration();
};

</script>

<template>
  <div>
    <h2>Login Page</h2>
    <form @submit.prevent="login">
      <div>
        <label for="email">Email</label>
        <input v-model="email" type="email" id="email" class="bg-transparent border border-gray-500" required />
      </div>
      <div>
        <label for="password">Password</label>
        <input v-model="password" type="password" id="password" class="bg-transparent border border-gray-500" required />
      </div>
      <button type="submit">Login</button>
    </form>
    <button @click="toggleRegister">Register</button>
  </div>
</template>

<style scoped></style>
