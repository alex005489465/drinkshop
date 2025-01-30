import { ref, computed } from 'vue';
import { defineStore } from 'pinia';

// 定義類別的接口
export interface Category {
  id: number;
  name: string;
}

// 定義飲料的接口
export interface Drink {
  id: string;
  name: string;
}

// 定義類別ID對應飲料資料的接口
export interface DrinksByCategory {
  [key: number]: Drink[];
}

// 定義後端回傳的完整類別介面 (含 category_id, product 等)
export interface CategoryFromBackend {
  category_id: number;
  name: string;
  product: {
    [key: string]: {
      id: string;
      name: string;
    };
  };
}

// 定義飲料詳細資料的接口
export interface DrinkDetail {
  product_id: string;
  name: string;
  description: string;
  calories: string;
  elements: string;
}

// 定義配料的接口
export interface Ingredient {
  id: number;
  name: string;
}

// 定義Pinia store
export const useProductStore = defineStore('product', () => {
  // 後端資料相關
  const categoriesFromBackend = ref<CategoryFromBackend[]>([]);
  const drinkDetails = ref<DrinkDetail[]>([]);

  // 選擇狀態相關
  // selectedCategoryId: 儲存當前選中的類別ID
  // null 表示未選中任何類別
  const selectedCategoryId = ref<number | null>(null);

  // selectedDrinkId: 儲存當前選中的飲料ID
  // null 表示未選中任何飲料
  const selectedDrinkId = ref<string | null>(null);

  // Computed 相關
  // categories: 將後端資料轉換為前端使用的類別格式
  // 從 categoriesFromBackend 中提取 category_id 和 name
  const categories = computed<Category[]>(() =>
    categoriesFromBackend.value.map((cat) => ({
      id: cat.category_id,  // 轉換 category_id 為 id
      name: cat.name       // 保持 name 不變
    }))
  );

  // drinksByCategory: 將飲料資料按類別ID分組
  // 建立一個物件，key 為類別ID，value 為該類別下的所有飲料
  const drinksByCategory = computed<DrinksByCategory>(() => {
    const result: DrinksByCategory = {};
    categoriesFromBackend.value.forEach((category) => {
      // 將每個類別的 product 物件轉換為陣列格式
      const drinks = Object.values(category.product).map(item => ({
        id: item.id,      // 保持 id 不變
        name: item.name   // 保持 name 不變
      }));
      // 以類別ID為key儲存飲料陣列
      result[category.category_id] = drinks;
    });
    return result;
  });

  // getDrinksBySelectedCategory: 根據選中的類別ID獲取該類別下的所有飲料
  // - 如果有選中類別 (selectedCategoryId !== null)
  //   返回該類別下的所有飲料陣列
  // - 如果沒有選中類別，返回空陣列
  const getDrinksBySelectedCategory = computed(() => {
    if (selectedCategoryId.value !== null) {
      return drinksByCategory.value[selectedCategoryId.value] || [];
    }
    return [];
  });

  // getDrinkById: 根據選中的飲料ID獲取該飲料的詳細資訊
  // - 如果有選中飲料 (selectedDrinkId !== null)
  //   在 drinkDetails 中查找對應的飲料資訊
  // - 如果沒有找到對應飲料，返回 null
  const getDrinkById = computed(() => {
    if (selectedDrinkId.value !== null) {
      return drinkDetails.value.find(drink => drink.product_id === selectedDrinkId.value) || null;
    }
    return null;
  });

  return {
    categoriesFromBackend,
    drinkDetails,
    selectedCategoryId,
    selectedDrinkId,
    categories,
    drinksByCategory,
    getDrinksBySelectedCategory,
    getDrinkById
  };
});
