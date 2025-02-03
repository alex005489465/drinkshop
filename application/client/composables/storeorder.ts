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
    products: `${apiUrl}/order/products`,
    orderItems: `${apiUrl}/order/items`
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

  const fetchOrderItemsFromBackend = async () => {
    try {
      // 模擬資料 Mock data
      const mockData: OrderItemInit[] = [
        {
          id: '01JK56DDB9HQPBKR48TCCAVC9N',
          name: '珍珠奶茶',
          sizes: {
            small: 50,
            medium: 60,
            large: 70,
            X_Large: 80
          },
          sugar: 5,
          ice: 5,
          toppings: [
            { id: 1, name: '珍珠', price: 10 },
            { id: 2, name: '波霸', price: 10 },
            { id: 3, name: '椰果', price: 5 }
          ]
        },
        {
          id: '01JK56DEGJADS6RF1ES15Z6FE0',
          name: '抹茶拿鐵',
          sizes: {
            small: 50,
            medium: 60,
            large: 70,
            X_Large: 80
          },
          sugar: 5,
          ice: 5,
          toppings: [
            { id: 1, name: '珍珠', price: 10 },
            { id: 2, name: '波霸', price: 10 },
            { id: 3, name: '椰果', price: 5 }
          ]
        }
      ];

      orderStore.$patch({
        orderItemInits: mockData
      });
      
    } catch (error) {
      console.error('Error fetching order items:', error);
      throw error;
    }
  };

  return {
    fetchProductsFromBackend,
    fetchOrderItemsFromBackend
  };
};