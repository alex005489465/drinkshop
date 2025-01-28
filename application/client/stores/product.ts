import { ref, computed } from 'vue';
import { defineStore } from 'pinia';

// 定義類別的接口
interface Category {
  id: number;
  name: string;
}

// 定義飲料的接口
interface Drink {
  id: number;
  name: string;
}

// 定義類別ID對應飲料資料的接口
interface DrinksByCategory {
  [key: number]: Drink[];
}

// 定義Pinia store
export const useProductStore = defineStore('product', () => {
  // 類別資料
  const categories = ref<Category[]>([
    { id: 1, name: '茶類' },
    { id: 2, name: '奶茶類' },
    { id: 3, name: '果茶類' }
  ]);

  // 類別ID對應的飲料資料
  const drinksByCategory = ref<DrinksByCategory>({
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

  // 所有飲料資料
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

  // 選中的類別ID
  const selectedCategoryId = ref<number | null>(null);

  // 選中的飲料ID
  const selectedDrinkId = ref<number | null>(null);

  // 函數：根據選中的類別ID提取對應的飲料資料
  const getDrinksBySelectedCategory = computed(() => {
    if (selectedCategoryId.value !== null) {
      return drinksByCategory.value[selectedCategoryId.value] || [];
    }
    return [];
  });

  // 函數：根據選中的飲料ID返回對應的飲料資料
  const getDrinkById = computed(() => {
    if (selectedDrinkId.value !== null) {
      return allDrinks.value.find(drink => drink.id === selectedDrinkId.value) || null;
    }
    return null;
  });

  // 返回store中的狀態和方法
  return { categories, drinksByCategory, allDrinks, selectedCategoryId, selectedDrinkId, getDrinksBySelectedCategory, getDrinkById };
});
