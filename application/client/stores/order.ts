import { defineStore } from 'pinia';
import { ref } from 'vue';

export interface Order {
    order_number: string;      // 訂單編號 Order number
    total_amount: number;      // 訂單總金額 Total amount
    status: 'pending' | 'processing' | 'completed' | 'cancelled';  // 訂單狀態 Order status
    created_at: string;        // 建立時間 Created time
}

export interface OrderDetail {
    order_number: string;      // 訂單編號 Order number
    items: Array<{            // 訂單項目 Order items
        product_id: string;     // 產品ID Product ID
        size: string;           // 杯型大小 Cup size
        unit_price: number;     // 單價 Unit price
        quantity: number;       // 數量 Quantity
        total_price: number;    // 總價 Total price
        ingredients: string[];  // 配料名稱 Ingredient names
        notes?: string;        // 備註 Notes (optional)
    }>;
    total_amount: number;     // 訂單總金額 Total amount
}

export const useOrderStore = defineStore('order', () => {
    const orders = ref<Order[]>([]);
    const orderDetail = ref<OrderDetail | null>(null);
    const selectedOrderNumber = ref<string | null>(null);

    return {
        orders,
        orderDetail,
        selectedOrderNumber
    };
});
