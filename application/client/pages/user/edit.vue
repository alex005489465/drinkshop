<script setup lang="ts">
definePageMeta({
  middleware: ['auth']
});

import { useUserProfile } from '~/composables/userprofile';
import { useUserStore } from '~/stores/user';
import { useRouter } from 'vue-router';
import { computed } from 'vue';
import type { FormState } from '~/stores/user';



const userStore = useUserStore();
const { updateProfile } = useUserProfile();
const router = useRouter();

// 表單數據
const formData = reactive({
  state: {
    user_name: userStore.profile?.user_name || '',
    gender: userStore.profile?.gender || '',
    birthdate: userStore.profile?.birthdate || '',
    nationality: userStore.profile?.nationality || '',
    id_number: userStore.profile?.id_number || '',
    notes: userStore.profile?.notes || '',
    user_email: userStore.profile?.user_email || '',
    backup_email: userStore.profile?.backup_email || '',
    phone: userStore.profile?.phone || '',
    residential_address: userStore.profile?.residential_address || '',
    mailing_address: userStore.profile?.mailing_address || ''
  } as FormState
});

// 格式化生日日期
const birthdateFormatted = computed({
  get: () => formData.state.birthdate || '',
  set: (value: string) => {
    formData.state.birthdate = value;
  }
});

// 提交表單
const handleSubmit = async () => {
  try {
    await updateProfile(formData.state);
    navigateTo('/user/member');
  } catch (error) {
    console.error('更新資料時發生錯誤:', error);
  }
};
</script>

<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center mb-12">
        <UButton 
          icon="i-heroicons-arrow-left" 
          color="gray" 
          variant="soft"
          @click="router.push('/user/member')"
        >
          返回
        </UButton>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">編輯資料</h1>
        <div class="w-24"></div>
      </div>

      <UForm :state="formData.state" @submit="handleSubmit">
        <UCard class="space-y-8">
          <!-- 基本資料 -->
          <div class="space-y-4">
            <h2 class="text-xl font-semibold">基本資料</h2>
            <UFormGroup label="用戶名稱">
              <UInput v-model="formData.state.user_name" />
            </UFormGroup>
            <UFormGroup label="性別">
              <USelect 
                v-model="formData.state.gender"
                :options="[
                  { label: '男', value: 'male' },
                  { label: '女', value: 'female' }
                ]"
              />
            </UFormGroup>
            <UFormGroup label="生日">
              <UInput 
                type="date" 
                v-model="birthdateFormatted"
                :placeholder="'YYYY-MM-DD'"
                value-format="YYYY-MM-DD"
              />
            </UFormGroup>
            <UFormGroup label="國籍">
              <UInput v-model="formData.state.nationality" />
            </UFormGroup>
            <UFormGroup label="身分證字號">
              <UInput v-model="formData.state.id_number" />
            </UFormGroup>
          </div>

          <!-- 聯絡資訊 -->
          <div class="space-y-4">
            <h2 class="text-xl font-semibold">聯絡資訊</h2>
            <UFormGroup label="主要電子郵件">
              <UInput type="email" v-model="formData.state.user_email" disabled />
            </UFormGroup>
            <UFormGroup label="備用電子郵件">
              <UInput type="email" v-model="formData.state.backup_email" />
            </UFormGroup>
            <UFormGroup label="聯絡電話">
              <UInput v-model="formData.state.phone" />
            </UFormGroup>
          </div>

          <!-- 居住資訊 -->
          <div class="space-y-4">
            <h2 class="text-xl font-semibold">居住資訊</h2>
            <UFormGroup label="戶籍地址">
              <UInput v-model="formData.state.residential_address" />
            </UFormGroup>
            <UFormGroup label="通訊地址">
              <UInput v-model="formData.state.mailing_address" />
            </UFormGroup>
          </div>

          <!-- 其他資訊 -->
          <div class="space-y-4">
            <h2 class="text-xl font-semibold">其他資訊</h2>
            <UFormGroup label="備註">
              <UTextarea v-model="formData.state.notes" />
            </UFormGroup>
          </div>

          <!-- 提交按鈕 -->
          <div class="flex justify-end">
            <UButton 
              type="submit"
              color="primary"
            >
              儲存變更
            </UButton>
          </div>
        </UCard>
      </UForm>
    </div>
  </div>
</template>