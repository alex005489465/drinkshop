import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export const useProductlistStore = defineStore('productlistStore', {
    state: () => ({
        products: ref([]),
        selectedProduct: null,
    }),
    actions: {
        async fetchProducts() {
            try {
                const response = await $fetch('http://127.0.0.1:8000/api/products');
                this.products.value = response;
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        },
        
        selectProduct(productId) {
            if (productId !== undefined) {
            this.selectedProduct = productId;
            } else {
            console.error('Product ID is undefined');
            }
        }
    },
    
    getters: {
        categories(state) {
            return computed(() => {
                const categories = reactive({ milk: [], tea: [], other: [] });

                if (!state.products.value) {
                    return categories; // Return empty categories if products are not loaded
                }

                state.products.value.forEach(product => {
                    const category = categories[product.category] || categories['other'];
                    category.push({
                    name: product.name,
                    productId: product.id,
                    });
                });

                return Object.entries(categories).map(([name, drinks]) => ({
                    name,
                    drinks,
                }));
            });
        },
        selectedProductDetails(state) {
            return computed(() => {
                return state.products.value.find(product => product.id === state.selectedProduct) || {};
            });
        }
    }
});
