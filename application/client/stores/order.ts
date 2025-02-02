import { defineStore } from 'pinia';
import { ref, computed, watch } from 'vue';
import { useProductStore } from './product';
import type { Category } from './product';

/**
 * 產品介面
 * Product interface
 */
export interface Product {
  id: number;          // 產品ID Product ID
  name: string;        // 產品名稱 Product name
  price: number;       // 產品價格 Product price
  image: string;       // 產品圖片 Product image
  category: Category;  // 產品分類 Product category
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

  return {
    categoryList,
    productList
  };
});