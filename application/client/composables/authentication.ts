import { useUrlStore } from '~/stores/url';
import { useAuthStore } from '~/stores/auth';

// 註冊介面
interface RegisterData {
  name: string;
  email: string;
  password: string;
  password_confirmation: string;
}

// 登入介面
interface LoginData {
  email: string;
  password: string;
}

// 回應介面
interface AuthResponse {
  message: string;
  user?: {
    name: string;
    email: string;
  };
}

export const useAuthentication = () => {
  const authStore = useAuthStore();
  const urlStore = useUrlStore();
  const apiUrl = urlStore.baseUrl;

  const API_ENDPOINTS = {
    register: `${apiUrl}/auth/register`,
    login: `${apiUrl}/auth/login`,
    logout: `${apiUrl}/auth/logout`,
    check: `${apiUrl}/auth/check`  // 新增檢查端點
  };

  /**
   * 用戶註冊
   */
  const register = async (data: RegisterData) => {
    try {
      const response = await fetch(API_ENDPOINTS.register, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        //credentials: 'include',
        body: JSON.stringify(data)
      });

      if (!response.ok) {
        const error = await response.json();
        throw new Error(error.message);
      }

      const responseData = await response.json();

      // 註冊成功後，用戶會自動登入，更新本地狀態
      if (responseData.user) {
        authStore.login(responseData.user);
      }

      return responseData;
    } catch (error) {
      console.error('註冊失敗:', error);
      throw error;
    }
  };

  /**
   * 用戶登入
   * @param data - 登入資料 (email, password)
   * @returns 登入回應，包含成功訊息和用戶資料
   * @throws 登入失敗時拋出錯誤
   */
  const login = async (credentials: LoginData) => {
    try {
      const response = await fetch(API_ENDPOINTS.login, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        credentials: 'include',
        body: JSON.stringify(credentials)
      });

      if (!response.ok) {
        throw new Error('Login failed');
      }

      const data = await response.json();
      if (data.user) {
        authStore.login(data.user);
      }

      return data;
    } catch (error) {
      console.error('登入失敗:', error);
      throw error;
    }
  };

  /**
   * 用戶登出
   */
  const logout = async () => {
    try {
      const response = await fetch(API_ENDPOINTS.logout, {
        method: 'POST',
        credentials: 'include'
      });

      if (!response.ok) {
        throw new Error('Logout failed');
      }

      const data = await response.json();
      authStore.logout();
      return data;
    } catch (error) {
      console.error('登出失敗:', error);
      throw error;
    }
  };

  /**
   * 檢查用戶登入狀態
   * @returns 是否已登入
   */
  const loginCheck = async () => {
    try {
      const { data: response, error } = await useFetch<AuthResponse>(API_ENDPOINTS.check, {
        method: 'POST',
        credentials: 'include'
      });

      if (error.value) {
        // 如果是 401，表示未登入
        if (error.value.statusCode === 401) {
          authStore.logout();
          return false;
        }
        throw new Error(error.value.data.message);
      }

      // 如果收到正確回應且有用戶資料，更新認證狀態
      if (response.value?.user) {
        authStore.login(response.value.user);
      }

      return true;
    } catch (error) {
      console.error('檢查登入狀態失敗:', error);
      return false;
    }
  };

  return {
    register,
    login,
    logout,
    loginCheck
  };
};