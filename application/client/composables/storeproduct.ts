import { ref, onMounted } from 'vue';
// ❶ 使用 type-only 方式導入
import type { CategoryFromBackend, DrinkDetail } from '~/stores/product';
import { useProductStore } from '~/stores/product';
import { useUrlStore } from '~/stores/url';

/**
 * 飲料商店相關功能的組合式函數
 */
export const useStoreproduct = () => {
  const store = useProductStore(); // 取得 store 實例
  const urlStore = useUrlStore();
  const apiUrl = urlStore.baseUrl;

  // API 端點
  const endpoints = {
    categoryList: `${apiUrl}/list`,      // 取得類別資料的端點
    drinkDetails: `${apiUrl}/description` // 取得飲料詳細資料的端點
  };

  /**
   * 從後端取得類別資料
   */
  const fetchCategoriesFromBackend = async () => {
    try {
      const response = await fetch(endpoints.categoryList);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const data = await response.json() as CategoryFromBackend[];
      store.categoriesFromBackend = data;
    } catch (error) {
      console.error('取得類別資料時發生錯誤:', error);
      throw error;
    }
  };

  /**
   * 從後端取得飲料詳細資料
   */
  const fetchDrinkDetails = async () => {
    try {
      const response = await fetch(endpoints.drinkDetails);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const data = await response.json() as DrinkDetail[];
      store.drinkDetails = data;
    } catch (error) {
      console.error('取得飲料詳細資料時發生錯誤:', error);
      throw error;
    }
  };

  // 返回可供外部使用的函數
  return {
    fetchCategoriesFromBackend,
    fetchDrinkDetails
  };
};
