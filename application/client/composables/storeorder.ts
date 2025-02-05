import { useUrlStore } from '~/stores/url';
import { useCartStore } from '~/stores/cart';
import { useOrderStore } from '~/stores/order';

interface OrderResponse {
  message: string;
  data: {
    order_number: string;
    total_amount: number;
  };
}

export const useStoreorder = () => {
  const urlStore = useUrlStore();
  const cartStore = useCartStore();
  const orderStore = useOrderStore();
  const apiUrl = urlStore.baseUrl;

  const endpoints = {
    submit: `${apiUrl}/order/submit`,
    list: `${apiUrl}/order/list`,
    detail: `${apiUrl}/order/detail`
  };

  /**
   * 送出訂單到後端
   * Submit order to backend
   */
  const submitOrderToBackend = async () => {
    const hasItems = Object.keys(cartStore.cartItems).length > 0;
    
    if (!hasItems) {
      throw new Error('購物車是空的');
    }

    const payload = {
      cart_items: cartStore.cartItems,
      total_amount: cartStore.total
    };

    try {
      const response = await fetch(endpoints.submit, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(payload)
      });

      if (!response.ok) {
        throw new Error('Failed to submit order');
      }

      const result = await response.json() as OrderResponse;
      
      // Clear cart after successful order
      cartStore.cartItems = {};

      return result;
    } catch (error) {
      console.error('Error submitting order:', error);
      throw error;
    }
  };

  /**
   * 從後端獲取訂單列表
   * Fetch order list from backend
   */
  const fetchOrderListFromBackend = async () => {
    try {
      const response = await fetch(endpoints.list);
      if (!response.ok) {
        throw new Error('Failed to fetch orders');
      }
      
      const { data } = await response.json();
      orderStore.orders = data;
    } catch (error) {
      console.error('Error fetching orders:', error);
      throw error;
    }
  };

  /**
   * 從後端獲取訂單詳細資料
   * Fetch order details from backend
   */
  const fetchOrderDetailFromBackend = async (orderNumber: string) => {
    try {
      const response = await fetch(endpoints.detail, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ order_number: orderNumber })
      });

      if (!response.ok) {
        throw new Error('Failed to fetch order detail');
      }
      
      const { data } = await response.json();
      orderStore.orderDetail = data;
    } catch (error) {
      console.error('Error fetching order detail:', error);
      throw error;
    }
  };

  return {
    submitOrderToBackend,
    fetchOrderListFromBackend,
    fetchOrderDetailFromBackend
  };
};