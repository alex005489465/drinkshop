import { defineStore } from 'pinia';
import { ref, computed, watch } from 'vue';
import { useProductStore } from './product';
import type { Category } from './product';

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

/**
 * 訂單相關的 Store
 * Store for order-related operations
 */
export const useOrderStore = defineStore('order', () => {
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

  return {
    categoryList,
    productList,
    orderItemInits,
    currentCategory,
    selectedProduct,
    selectedOrderItem
  };
});