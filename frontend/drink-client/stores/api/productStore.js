import { defineStore } from 'pinia';
import { computed } from 'vue';
import { useProductlistStore } from '@/stores/api/productlistStore';

export const useProductStore = defineStore('productStore', {
    state: () => ({
        productsdata
    }),
    getters: {
        selectedProductDetails: (state) => {
            const productlistStore = useProductlistStore();
            const selectedProductId = productlistStore.selectedProduct;
            return state.productsdata.find(product => product.id === selectedProductId) || {};
        }
    }
});

const productsdata = [
    {
        id: 1,
        name: 'Classic Milk Tea',
        description: 'A smooth and rich milk tea with a classic taste.',
        price: 3.50,
        category: 'milk tea',
        image_url: 'https://via.placeholder.com/640x480.png/00ccaa?text=Classic+Milk+Tea',
        created_at: '2024-12-10T10:30:00.000000Z',
        updated_at: '2024-12-10T10:30:00.000000Z'
    },
    {
        id: 2,
        name: 'Matcha Milk Tea',
        description: 'A refreshing blend of matcha and milk for a perfect balance.',
        price: 4.00,
        category: 'milk tea',
        image_url: 'https://via.placeholder.com/640x480.png/00ccaa?text=Matcha+Milk+Tea',
        created_at: '2024-12-11T11:00:00.000000Z',
        updated_at: '2024-12-11T11:00:00.000000Z'
    },
    {
        id: 3,
        name: 'Brown Sugar Milk Tea',
        description: 'Sweet and creamy milk tea with a rich brown sugar flavor.',
        price: 4.50,
        category: 'milk tea',
        image_url: 'https://via.placeholder.com/640x480.png/00ccaa?text=Brown+Sugar+Milk+Tea',
        created_at: '2024-12-12T12:45:00.000000Z',
        updated_at: '2024-12-12T12:45:00.000000Z'
    },
    {
        id: 4,
        name: 'Green Tea',
        description: 'A pure and refreshing green tea with a delicate taste.',
        price: 2.50,
        category: 'tea',
        image_url: 'https://via.placeholder.com/640x480.png/00ccaa?text=Green+Tea',
        created_at: '2024-12-13T09:15:00.000000Z',
        updated_at: '2024-12-13T09:15:00.000000Z'
    },
    {
        id: 5,
        name: 'Oolong Tea',
        description: 'A fragrant and aromatic tea with a full-bodied flavor.',
        price: 3.00,
        category: 'tea',
        image_url: 'https://via.placeholder.com/640x480.png/00ccaa?text=Oolong+Tea',
        created_at: '2024-12-13T09:45:00.000000Z',
        updated_at: '2024-12-13T09:45:00.000000Z'
    }
];