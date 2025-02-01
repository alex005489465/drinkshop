import { defineStore } from 'pinia';
import { ref } from 'vue';

/**
 * 使用者檔案介面
 * 定義使用者的基本資料、聯絡方式等相關資訊
 */
export interface UserProfile {
    user_name: string;             // 使用者名稱
    gender: string | null;         // 性別
    birthdate: string | null;      // 生日
    nationality: string | null;    // 國籍
    id_number: string | null;      // 身分證字號
    notes: string | null;         // 備註
    user_email: string;           // 主要電子郵件
    backup_email: string | null;   // 備用電子郵件
    phone: string | null;         // 聯絡電話
    residential_address: string | null;  // 戶籍地址
    mailing_address: string | null;     // 通訊地址
}

/**
 * 會員明細介面
 * 定義會員等級、點數等相關資訊
 */
export interface MemberDetail {
    points_balance: number;         // 點數餘額
    membership_level: string;       // 會員等級
    points_expire_at: string | null;  // 點數到期時間
    last_activity_at: string | null;  // 最後活動時間
}

export const useUserStore = defineStore('user', () => {
    const profile = ref<UserProfile | null>(null);
    const memberDetail = ref<MemberDetail | null>(null);

    return {
        profile,
        memberDetail
    };
});