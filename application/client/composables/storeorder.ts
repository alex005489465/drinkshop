import { useUrlStore } from '~/stores/url';
import { useOrderStore } from '~/stores/order';
import type { Product } from '~/stores/order';

/**
 * API 回應格式介面
 * Interface for API response
 */
interface ApiResponse {
  data: Product[];
}

/**
 * Order 相關的 API 操作
 * Composable for order-related API operations
 */
export const useStoreorder = () => {
  const urlStore = useUrlStore();
  const orderStore = useOrderStore();
  const apiUrl = urlStore.baseUrl;

  // API 端點設定
  // API endpoint configuration
  const endpoints = {
    products: `${apiUrl}/order/products`
  };

  /**
   * 從後端獲取產品列表
   * Fetch product list from backend
   */
  const fetchProductsFromBackend = async () => {
    try {
      const { data: response } = await useFetch<ApiResponse>(endpoints.products);
      
      if (response.value) {
        // 更新 store 中的產品列表
        // Update product list in store
        orderStore.$patch({
          productList: response.value.data
        });
      }
    } catch (error) {
      console.error('Error fetching products:', error);
      throw error;
    }
  };

  return {
    fetchProductsFromBackend
  };
};