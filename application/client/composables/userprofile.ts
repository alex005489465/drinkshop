import { useUserStore } from '~/stores/user';
import { useUrlStore } from '~/stores/url';
import type { UserProfile, MemberDetail } from '~/stores/user';

export const useUserProfile = () => {
  const userStore = useUserStore();
  const urlStore = useUrlStore();

  // API 端點
  const API_ENDPOINTS = {
    profile: `${urlStore.baseUrl}/user/profile`,
    member: `${urlStore.baseUrl}/user/member`,
    updateProfile: `${urlStore.baseUrl}/user/profile`  // 更新用戶資料端點
  };

  const fetchUserProfile = async () => {
    const { data, error } = await useFetch<{ data: UserProfile }>(API_ENDPOINTS.profile);
    
    if (error.value) {
      console.error('獲取用戶資料失敗:', error.value);
      return;
    }

    if (data.value) {
      userStore.profile = data.value.data;
    }
  };

  const fetchMemberDetails = async () => {
    const { data, error } = await useFetch<{ data: MemberDetail }>(API_ENDPOINTS.member);
    
    if (error.value) {
      console.error('獲取會員資料失敗:', error.value);
      return;
    }

    if (data.value) {
      userStore.memberDetail = data.value.data;
    }
  };

  const updateProfile = async (profileData: Partial<UserProfile>) => {
    try {
      const { data, error } = await useFetch<{ data: UserProfile }>(API_ENDPOINTS.updateProfile, {
        method: 'POST',
        body: profileData
      });
      
      if (error.value) {
        console.error('更新用戶資料失敗:', error.value);
        return false;
      }

      if (data.value) {
        userStore.profile = data.value.data;
        return true;
      }
    } catch (error) {
      console.error('更新用戶資料失敗:', error);
      return false;
    }
  };

  return {
    fetchUserProfile,
    fetchMemberDetails,
    updateProfile
  };
};