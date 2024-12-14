import { defineStore } from 'pinia';
import { useAuthStore } from './authStore';

export const useRegisterStore = defineStore('register', {
    state: () => ({
        isRegistered: false,
    }),
    actions: {
        async register(userInfo) {
            try {
                const response = await fetch('http://127.0.0.1:8000/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(userInfo),
                });

                if (response.status === 207) { // Registration successful response status code is 207
                    this.isRegistered = false;

                    const authStore = useAuthStore(); 
                    authStore.isLoggedIn = true
                    // Save other user information as needed
                } else {
                    throw new Error('Registration failed');
                }
            } catch (error) {
                console.error('Registration failed:', error);
                // Handle registration failure, such as displaying error messages
            }
        },
        setRegistered(value) {
            this.isRegistered = value;
        },
        toggleRegistration() {
            this.isRegistered = !this.isRegistered;
        }
    },
});