import { ref, onMounted } from 'vue';
// ❶ 使用 type-only 方式導入
import type { CategoryFromBackend, DrinkDetail } from '~/stores/product';
import { useProductStore } from '~/stores/product';

/**
 * 飲料商店相關功能的組合式函數
 */
export const useStoreproduct = () => {
  const config = useRuntimeConfig(); // 已預設導入
  const baseUrl = config.public.apiBase;
  const store = useProductStore(); // 取得 store 實例

  /**
   * 從後端取得類別資料
   */
  const fetchCategoriesFromBackend = async () => {
    const { data, error } = await useFetch<CategoryFromBackend[]>(`${baseUrl}/shops/list`);
    if (error.value) {
      console.error('取得類別資料時發生錯誤:', error.value);
    } else if (data.value) {
      store.categoriesFromBackend = data.value;
    }
  };

  /**
   * 從後端取得飲料詳細資料
   */
  const fetchDrinkDetails = async () => {
    const { data, error } = await useFetch<DrinkDetail[]>(`${baseUrl}/shops/description`);
    if (error.value) {
      console.error('取得飲料詳細資料時發生錯誤:', error.value);
    } else if (data.value) {
      store.drinkDetails = data.value;
    }
  };

  /**
   * 組件掛載時自動執行
   */
  onMounted(() => {
    fetchCategoriesFromBackend();
    fetchDrinkDetails();
  });

  // 返回可供外部使用的函數
  return {
    fetchCategoriesFromBackend,
    fetchDrinkDetails
  };
};
