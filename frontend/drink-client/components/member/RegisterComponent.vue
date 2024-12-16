<script setup lang="ts">
import { ref } from 'vue';
import { useRegisterStore } from '@/stores/member/registerStore';

const name = ref('');
const email = ref('');
const password = ref('');
const passwordConfirmation = ref('');

const registerStore = useRegisterStore();

const register = async () => {
  try {
    await registerStore.register({
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: passwordConfirmation.value,
    });
  } catch (error) {
    console.error('Registration failed:', error); // Handle registration failure, e.g., display error message
  }
};

const cancel = () => {
  registerStore.setRegistered(false);
};

</script>

<template>
  <div>
    <h2>Register</h2>
    <form @submit.prevent="register">
      <div>
        <label for="name">Name</label>
        <input v-model="name" type="text" id="name" required autocomplete="name" class="bg-transparent border border-gray-500" />
      </div>
      <div>
        <label for="email">Email</label>
        <input v-model="email" type="email" id="email" required autocomplete="email" class="bg-transparent border border-gray-500" />
      </div>
      <div>
        <label for="password">Password</label>
        <input v-model="password" type="password" id="password" required autocomplete="new-password" class="bg-transparent border border-gray-500" />
      </div>
      <div>
        <label for="password_confirmation">Confirm Password</label>
        <input v-model="passwordConfirmation" type="password" id="password_confirmation" required autocomplete="new-password" class="bg-transparent border border-gray-500" />
      </div>
      <button type="submit">Register</button>
      <button type="button" @click="cancel">Cancel</button>
    </form>
  </div>
</template>

<style scoped></style>
