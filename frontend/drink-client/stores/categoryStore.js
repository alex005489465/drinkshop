import { defineStore } from 'pinia';

export const useCategoryStore = defineStore('categoryStore', {
    state: () => ({
        categories,
        selectedProduct: null,
    }),
    actions: {
        toggleCategory(category) {
            category.isOpen = !category.isOpen;
        },
        selectProduct(productId) {
            this.selectedProduct = productId;
        }
    }
});

const categories = [
    {
        name: 'milk tea',
        drinks: [
            { name: 'Classic Milk Tea', productId: 1 },
            { name: 'Matcha Milk Tea', productId: 2 },
            { name: 'Brown Sugar Milk Tea', productId: 3 }
        ],
        isOpen: false
    },
    {
        name: 'tea',
        drinks: [
            { name: 'Green Tea', productId: 4 },
            { name: 'Black Tea', productId: 5 },
            { name: 'Oolong Tea', productId: 6 }
        ],
        isOpen: false
    },
    {
        name: 'other',
        drinks: [
            { name: 'Lemonade', productId: 7 },
            { name: 'Herbal Infusion', productId: 8 },
            { name: 'Iced Coffee', productId: 9 }
        ],
        isOpen: false
    }
]