import { useUserStore } from '~/stores/user';
import { useUrlStore } from '~/stores/url';
import type { UserProfile, MemberDetail, FormState } from '~/stores/user';

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
    try {
      const response = await fetch(API_ENDPOINTS.profile, {
        credentials: 'include'
      });

      if (!response.ok) {
        throw new Error('Failed to fetch user profile');
      }

      const { data } = await response.json() as { data: UserProfile };
      userStore.profile = data;
    } catch (error) {
      console.error('獲取用戶資料失敗:', error);
      throw error;
    }
  };

  const fetchMemberDetails = async () => {
    try {
      const response = await fetch(API_ENDPOINTS.member, {
        credentials: 'include'
      });

      if (!response.ok) {
        throw new Error('Failed to fetch member details');
      }

      const { data } = await response.json() as { data: MemberDetail };
      userStore.memberDetail = data;
    } catch (error) {
      console.error('獲取會員資料失敗:', error);
      throw error;
    }
  };

  const updateProfile = async (profileData: FormState) => {
    try {
      const response = await fetch(API_ENDPOINTS.updateProfile, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        credentials: 'include',
        body: JSON.stringify(profileData)
      });

      if (!response.ok) {
        throw new Error('Failed to update profile');
      }

      const { data } = await response.json() as { data: UserProfile };
      userStore.profile = data;
    } catch (error) {
      console.error('更新用戶資料失敗:', error);
      throw error;
    }
  };

  return {
    fetchUserProfile,
    fetchMemberDetails,
    updateProfile
  };
};