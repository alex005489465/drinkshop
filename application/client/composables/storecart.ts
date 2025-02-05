import { useUrlStore } from '~/stores/url';
import { useCartStore } from '~/stores/cart';
import type { Product } from '~/stores/cart';

interface CartItemsResponse {
  message: string;
  data: OrderItemInit[];
}

// Add interface for cart response
interface CartResponse {
  message: string;
  data: {
    cart_items: Record<number, CartItem> | null;
    total_amount: number;
  };
}

/**
 * Cart 相關的 API 操作
 * Composable for cart-related API operations
 */
export const useStorecart = () => {
  const cartStore = useCartStore();
  const urlStore = useUrlStore();
  const apiUrl = urlStore.baseUrl;

  // API 端點設定
  // API endpoint configuration
  const endpoints = {
    products: `${apiUrl}/cart/products`,
    cartItems: `${apiUrl}/cart/inititems`,
    saveItems: `${apiUrl}/cart/saveitems`,
    getItems: `${apiUrl}/cart/getitems`
  };

  /**
   * 
   * 從後端取得產品列表
   * Fetch product list from backend
   */
  const fetchProductsFromBackend = async () => {
    try {
      const response = await fetch(endpoints.products);
      if (!response.ok) {
        throw new Error('Failed to fetch products');
      }
      const { data } = await response.json() as { data: Product[] };
      cartStore.$patch((state) => {
        state.productList = data;
      });
    } catch (error) {
      console.error('取得產品列表時發生錯誤:', error);
      throw error;
    }
  };

  /**
   * 從後端獲取菜單資料
   * Fetch cart items from backend
   */
  const fetchCartItemsFromBackend = async () => {
    try {
      const response = await fetch(endpoints.cartItems);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const { data } = await response.json() as CartItemsResponse;
      
      cartStore.$patch({
        orderItemInits: data
      });
      
    } catch (error) {
      console.error('Error fetching cart items:', error);
      throw error;
    }
  };

  /**
   * 保存購物車內容到後端
   * Save cart items to backend
   */
  const saveCartItemsToBackend = async () => {
    const hasItems = Object.keys(cartStore.cartItems).length > 0;
    
    const payload = {
      cart_items: hasItems ? cartStore.cartItems : null,
      total_amount: hasItems ? cartStore.total : 0
    };

    try {
      const response = await fetch(endpoints.saveItems, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(payload)
      });

      if (!response.ok) {
        throw new Error('Failed to save cart items');
      }

      return await response.json();
    } catch (error) {
      console.error('Error saving cart items:', error);
      throw error;
    }
  };

  /**
   * 從後端獲取購物車資料
   * Fetch cart items from backend
   */
  const fetchCartFromBackend = async () => {
    try {
      const response = await fetch(endpoints.getItems);
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const { data } = await response.json() as CartResponse;
      
      // Update cart store state
      cartStore.$patch({
        cartItems: data.cart_items || {}
      });
      
    } catch (error) {
      console.error('Error fetching cart:', error);
      throw error;
    }
  };

  return {
    fetchProductsFromBackend,
    fetchCartItemsFromBackend,
    saveCartItemsToBackend,
    fetchCartFromBackend
  };
};