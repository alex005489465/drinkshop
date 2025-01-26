<script setup lang="ts">
import { useProductStore } from '~/stores/product';
import { storeToRefs } from 'pinia';

const productStore = useProductStore();
const { getCategories, getDrinksByCategoryId } = storeToRefs(productStore);
const selectCategory = productStore.selectCategory;
const selectDrink = productStore.selectDrink;

const categories = computed(() =>
  getCategories.value.map((category) => ({
    label: category.name,
    id: category.id,
    icon: 'i-heroicons-cube' // 更好看的圖標
  }))
);

const handleCategoryClick = (id: number) => {
  selectCategory(id);
};

const handleDrinkClick = (id: number) => {
  selectDrink(id);
};

const drinksLinks = computed(() =>
  getDrinksByCategoryId.value.map((drink: { id: number; name: string }) => ({
    label: drink.name,
    id: drink.id
  }))
);
</script>

<template>
  <UAccordion :items="categories">
    <template #default="{ item, open }">
      <div>
        <UButton as="div" color="gray" variant="ghost" class="border-b border-gray-200 dark:border-gray-700" :ui="{ rounded: 'rounded-none', padding: { sm: 'p-3' } }" @click="handleCategoryClick(item.id)">
          <template #leading>
            <div class="w-6 h-6 rounded-full bg-primary-500 dark:bg-primary-400 flex items-center justify-center -my-1 mr-4">
              <UIcon :name="item.icon" class="w-4 h-4 text-white dark:text-gray-900" />
            </div>
          </template>

          <span class="truncate">{{ item.label }}</span>

          <template #trailing>
            <UIcon
              name="i-heroicons-chevron-right-20-solid"
              class="w-5 h-5 ms-auto transform transition-transform duration-200"
              :class="[open && 'rotate-90']"
            />
          </template>
        </UButton>
        <UVerticalNavigation v-if="open && drinksLinks.length" :links="drinksLinks" class="pl-8" @click="(event) => handleDrinkClick(event.detail.link.id)" />
      </div>
    </template>
  </UAccordion>
</template>

<style scoped>
.border-b {
  border-bottom-width: 1px;
}

.border-gray-200 {
  border-color: #e5e7eb;
}

.dark\:border-gray-700 {
  border-color: #374151;
}

.bg-primary-500 {
  background-color: #3b82f6;
}

.dark\:bg-primary-400 {
  background-color: #60a5fa;
}

.text-white {
  color: #ffffff;
}

.dark\:text-gray-900 {
  color: #111827;
}

.pl-8 {
  padding-left: 2rem;
}
</style>
