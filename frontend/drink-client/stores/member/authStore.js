import { defineStore } from 'pinia';

export const useAuthStore = defineStore('authstore', {
    state: () => ({
        isLoggedIn: false,
    }),
    actions: {
        async login(userInfo) {
            try {
                const response = await fetch('http://127.0.0.1:8000/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(userInfo),
                });
                if (response.status === 208) {
                    this.isLoggedIn = true;
                    // Save token or user information as needed
                } else {
                    throw new Error('Login failed');
                }
            } catch (error) {
                console.error('Login failed:', error);
                // Handle login failure, such as displaying an error message
            }
        },
        async logout() {
            try {
                const response = await fetch('http://127.0.0.1:8000/logout', {
                    method: 'POST',
                });
                if (response.status === 209) {
                    this.isLoggedIn = false;
                    // Perform other cleanup operations as needed
                } else {
                    throw new Error('Logout failed');
                }
            } catch (error) {
                console.error('Logout failed:', error);
                // Handle logout failure, such as displaying an error message
            }
        },
    },
});
