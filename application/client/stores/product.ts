import { ref, computed } from 'vue';
import { defineStore } from 'pinia';

interface Drink {
  id: number;
  name: string;
}

interface Drinks {
  [key: number]: Drink[];
}

export const useProductStore = defineStore('product', () => {
  const categories = ref([
    { id: 1, name: '茶類' },
    { id: 2, name: '奶茶類' },
    { id: 3, name: '果茶類' }
  ]);

  const drinks = ref<Drinks>({
    1: [
      { id: 1, name: '綠茶' },
      { id: 2, name: '紅茶' },
      { id: 3, name: '烏龍茶' }
    ],
    2: [
      { id: 4, name: '珍珠奶茶' },
      { id: 5, name: '抹茶拿鐵' },
      { id: 6, name: '巧克力奶茶' }
    ],
    3: [
      { id: 7, name: '藍莓果茶' },
      { id: 8, name: '百香果綠茶' },
      { id: 9, name: '葡萄柚綠茶' }
    ]
  });

  // 新增一個變數來存放所有飲料的資料
  const allDrinks = ref<Drink[]>([
    { id: 1, name: '綠茶' },
    { id: 2, name: '紅茶' },
    { id: 3, name: '烏龍茶' },
    { id: 4, name: '珍珠奶茶' },
    { id: 5, name: '抹茶拿鐵' },
    { id: 6, name: '巧克力奶茶' },
    { id: 7, name: '藍莓果茶' },
    { id: 8, name: '百香果綠茶' },
    { id: 9, name: '葡萄柚綠茶' }
  ]);

  const selectedCategoryId = ref<number | null>(null);
  const selectedDrinkId = ref<number | null>(null);

  const getCategories = computed(() => categories.value);

  const getDrinksByCategoryId = computed(() => {
    return selectedCategoryId.value ? drinks.value[selectedCategoryId.value] : [];
  });

  const selectCategory = (id: number) => {
    selectedCategoryId.value = id;
  };

  const selectDrink = (id: number) => {
    selectedDrinkId.value = id;
  };

  const selectedDrink = computed(() => {
    if (selectedCategoryId.value === null) return null;
    const categoryDrinks = drinks.value[selectedCategoryId.value];
    return categoryDrinks.find(drink => drink.id === selectedDrinkId.value) || null;
  });

  return { categories, getCategories, getDrinksByCategoryId, selectCategory, selectDrink, selectedDrinkId, selectedDrink, drinks };
});