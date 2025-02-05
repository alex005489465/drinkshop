import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

/**
 * 產品介面
 * Product interface
 */
export interface Product {
  id: string;          // 產品ID Product ID
  name: string;        // 產品名稱 Product name
  price: number;       // 產品價格 Product price
  image: string;       // 產品圖片 Product image
  category: Category;  // 產品分類 Product category
}

/**
 * 訂單初始化介面
 * Order Initialization Interface
 */
export interface OrderItemInit {
  id: string;               // 飲料ID Drink ID
  name: string;            // 飲料名稱 Drink name
  sizes: {                 // 杯型價格 Size prices
    small: number;
    medium: number;
    large: number;
    X_Large: number;
  };
  sugar: number;           // 糖度 Sugar level (1-5)
  ice: number;            // 冰塊 Ice level (1-5)
  toppings: Array<{       // 配料 Toppings
    id: number;
    name: string;
    price: number;
  }>;
}

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

/**
 * 選中編輯項目類型
 * Selected edit item type
 */
export interface SelectedEditItem {
  index: number;      // 購物車項目索引 Cart item index
  drinkId: string;    // 飲料ID Drink ID
}

export const useCartStore = defineStore('cart', () => {
  const productStore = useProductStore();

  /**
   * 分類列表，包含"全部"選項和後端分類
   * Category list including "All" option and backend categories
   */
  const categoryList = computed(() => [
    { id: 0, name: '全部' },
    ...productStore.categories
  ]);

  /**
   * 產品列表
   * Product list
   */
  const productList = ref<Product[]>([]);

  const orderItemInits = ref<OrderItemInit[]>([]);

  /**
   * 當前選中的分類
   * Current selected category
   */
  const currentCategory = ref(categoryList.value[0]);
  
  /**
   * 當前選中的產品
   * Current selected product
   */
  const selectedProduct = ref<Product | null>(null);

  /**
   * 當前選中的訂單項目
   * Currently selected order item
   */
  const selectedOrderItem = computed<OrderItemInit | null>(() => {
    if (!selectedProduct.value) return null;
    return orderItemInits.value.find(item => item.id === selectedProduct.value?.id) || null;
  });

  /**
   * 購物車項目列表
   * Cart items list
   */
  const cartItems = ref<Record<number, CartItem>>({});

  /**
   * 當前編輯項目
   * Current editing item
   */
  const selectedEditItem = ref<SelectedEditItem | null>(null);

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

  /**
   * 當前顯示的訂單初始化數據
   * Current display order initialization data
   */
  const currentDisplay = computed<OrderItemInit | null>(() => {
    if (!selectedEditItem.value?.drinkId) return null;
    return orderItemInits.value.find(item => item.id === selectedEditItem.value?.drinkId) || null;
  });

  /**
   * 當前編輯的購物車項目
   * Current editing cart item
   */
  const currentItem = computed<CartItem | null>(() => {
    if (!selectedEditItem.value?.index) return null;
    return cartItems.value[selectedEditItem.value.index] || null;
  });

  return {
    categoryList,
    productList,
    orderItemInits,
    currentCategory,
    selectedProduct,
    selectedOrderItem,
    cartItems,
    selectedEditItem,
    totalQuantity,
    total,
    currentDisplay,
    currentItem
  };
});