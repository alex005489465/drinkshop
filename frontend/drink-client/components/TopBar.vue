<script setup lang="ts"></script>

<template>
  <div class="topbar">
    <!-- Logo 
    <div class="logo">
      <img src="/path/to/logo.png" alt="Logo">
    </div>
    -->
    <nav>
      <a href="/">首頁</a>
      <a href="/product">產品</a>
      <a href="/about">關於我們</a>
      <a href="/contact">聯繫方式</a>
    </nav>
    <DarkModeToggle />
    <!-- Search Bar 
    <div class="search-bar">
      <input type="text" placeholder="搜索飲料...">
    </div>
    -->
    <!-- Cart and User Account Icons
    <div class="cart">
      <a href="/cart"><img src="/path/to/cart-icon.png" alt="購物車"></a>
    </div>
    <div class="user-account">
      <a href="/login">登錄</a> / <a href="/register">註冊</a>
    </div>
    -->
  </div>
</template>

<style scoped>
.topbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
  /* background-color: #f8f9fa; */ /* see DarkModeToggle.vue */
}

.logo img {
  height: 40px;
}

nav a {
  margin: 0 10px;
  text-decoration: none;
  /* color: #333; */  /* see DarkModeToggle.vue */
}

.search-bar input {
  padding: 5px;
  font-size: 16px;
}

.cart img {
  height: 30px;
}

.user-account a {
  margin: 0 5px;
  text-decoration: none;
  /* color: #333; */ /* see DarkModeToggle.vue */
}
</style>
