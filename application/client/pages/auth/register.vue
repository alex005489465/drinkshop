<script setup lang="ts">
import { ref } from 'vue';
import { useAuthentication } from '~/composables/authentication';

// 初始化表單數據
const formData = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
});

// 錯誤訊息狀態
const error = ref('');

// 取得認證方法
const { register } = useAuthentication();

// 處理表單提交
const handleSubmit = async () => {
  try {
    error.value = '';
    await register(formData.value);
    navigateTo('/');
  } catch (err: any) {
    error.value = err.message || '註冊失敗，請稍後再試';
  }
};
</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <!-- 頁面標題 -->
      <div class="text-center">
        <h2 class="mt-6 text-3xl font-extrabold text-gray-900 dark:text-white">
          註冊帳號
        </h2>
      </div>

      <!-- 註冊表單 -->
      <form class="mt-8 space-y-6" @submit.prevent="handleSubmit">
        <!-- 錯誤訊息 -->
        <div v-if="error" class="rounded-md bg-red-50 dark:bg-red-900 p-4">
          <p class="text-sm text-red-700 dark:text-red-200">{{ error }}</p>
        </div>

        <!-- 表單欄位 -->
        <div class="rounded-md shadow-sm -space-y-px">
          <div>
            <label for="name" class="sr-only">姓名</label>
            <input
              id="name"
              v-model="formData.name"
              type="text"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-600 dark:focus:border-indigo-600 focus:z-10 sm:text-sm bg-white dark:bg-gray-800"
              placeholder="姓名"
            >
          </div>
          <div>
            <label for="email" class="sr-only">電子郵件</label>
            <input
              id="email"
              v-model="formData.email"
              type="email"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-600 dark:focus:border-indigo-600 focus:z-10 sm:text-sm bg-white dark:bg-gray-800"
              placeholder="電子郵件"
            >
          </div>
          <div>
            <label for="password" class="sr-only">密碼</label>
            <input
              id="password"
              v-model="formData.password"
              type="password"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-600 dark:focus:border-indigo-600 focus:z-10 sm:text-sm bg-white dark:bg-gray-800"
              placeholder="密碼"
            >
          </div>
          <div>
            <label for="password_confirmation" class="sr-only">確認密碼</label>
            <input
              id="password_confirmation"
              v-model="formData.password_confirmation"
              type="password"
              required
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 placeholder-gray-500 dark:placeholder-gray-400 text-gray-900 dark:text-white rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-600 dark:focus:border-indigo-600 focus:z-10 sm:text-sm bg-white dark:bg-gray-800"
              placeholder="確認密碼"
            >
          </div>
        </div>

        <!-- 註冊按鈕 -->
        <div>
          <button
            type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-900"
          >
            註冊
          </button>
        </div>

        <!-- 登入連結 -->
        <div class="text-center">
          <NuxtLink
            to="/auth/login"
            class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300"
          >
            已有帳號？立即登入
          </NuxtLink>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped></style>
