<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            // 基本識別欄位
            $table->id();                                    // 用戶檔案主鍵
            $table->unsignedBigInteger('user_id')->unique();// 對應 users 表的用戶 ID
            $table->string('user_name');                    // 用戶名稱
            $table->string('nickname')->nullable();          // 用戶暱稱
            
            // 個人基本資料
            $table->enum('gender', ['male', 'female'])->nullable(); // 性別
            $table->date('birthdate')->nullable();          // 生日
            $table->string('nationality')->nullable();       // 國籍
            $table->string('id_number')->nullable();        // 身分證字號
            $table->text('notes')->nullable();              // 備註欄位
            
            // 聯絡資訊欄位
            $table->string('user_email');                   // 主要電子郵件，用於登入和主要聯繫
            $table->string('backup_email')->nullable();     // 備用電子郵件，用於備份和緊急聯繫
            $table->string('phone')->nullable();            // 聯絡電話
            $table->string('residential_address')->nullable(); // 戶籍地址
            $table->string('mailing_address')->nullable();    // 通訊地址
            
            // 會員相關欄位
            $table->timestamp('member_since')->useCurrent(); // 成為會員的時間，預設為建檔時間
            
            // 時間戳記
            $table->timestamps();                           // 建立和更新時間
            $table->softDeletes();                         // 軟刪除，保留資料但標記為已刪除
        });

        Schema::create('member_details', function (Blueprint $table) {
            // 基本識別欄位
            $table->id();                                    // 會員明細主鍵
            $table->unsignedBigInteger('user_id')->unique(); // 對應 users 表的 ID
            
            // 會員積分相關
            $table->integer('points_balance')->default(0);   // 目前點數餘額
            $table->string('membership_level')->default('normal'); // 會員等級(normal/silver/gold)
            $table->timestamp('points_expire_at')->nullable(); // 點數到期時間
            $table->timestamp('last_activity_at')->nullable(); // 最後活動時間

            // 時間戳記
            $table->timestamps();                           // 建立和更新時間
            $table->softDeletes();                         // 軟刪除，保留資料但標記為已刪除
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
        Schema::dropIfExists('member_details');
    }
};
