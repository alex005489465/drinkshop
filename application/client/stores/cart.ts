import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export interface CartItem {
  drinkId: string;           // 飲料ID Drink ID
  drinkName: string;         // 飲料名稱 Drink name
  size: {                    // 杯型選擇 Size selection
    type: 'small' | 'medium' | 'large' | 'X_Large';
    price: number;
  };
  sugar: number;             // 糖度 Sugar level (1-5)
  ice: number;              // 冰塊 Ice level (1-5)
  toppings?: Array<{         // 已選配料 Selected toppings (optional)
    id: number;
    name: string;
    price: number;
  }>;
  price: number;             // 單價 Unit price
  quantity: number;          // 數量 Quantity
  subtotal: number;          // 小計 Subtotal
  note?: string;            // 備註 Note (optional)
}

export const useCartStore = defineStore('cart', () => {
  /**
   * 購物車項目列表
   * Cart items list
   */
  const cartItems = ref<Record<number, CartItem>>({});
  const selectedEditItem = ref<number | null>(null);

  /**
   * 計算購物車總數量
   * Calculate cart total quantity
   */
  const totalQuantity = computed(() => 
    Object.values(cartItems.value).reduce((sum, item) => sum + item.quantity, 0)
  );

  /**
   * 計算購物車總價
   * Calculate cart total price
   */
  const total = computed(() => 
    Object.values(cartItems.value).reduce((sum, item) => sum + item.subtotal, 0)
  );

  return {
    cartItems,
    totalQuantity,
    total,
    selectedEditItem
  };
});