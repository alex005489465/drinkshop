<script setup lang="ts">
import CategoryList from '~/components/product/categorylist.vue';
import ProductDescription from '~/components/product/productdescription.vue';
</script>

<template>
  <div class="flex">
    <div class="left-pane">
      <CategoryList />
    </div>
    <div class="right-pane">
      <ProductDescription />
    </div>
  </div>
</template>

<style scoped>
.flex {
  display: flex;
}

.left-pane {
  flex: 0 0 30%;
  min-width: 200px; /* 最小寬度 */
  background-color: #f0f0f0; /* 普通模式背景顏色 */
  padding: 1rem; /* 內邊距 */
}

.right-pane {
  flex: 1;
  background-color: #ffffff; /* 普通模式背景顏色 */
  padding: 1rem; /* 內邊距 */
}

/* 深色模式 */
@media (prefers-color-scheme: dark) {
  .left-pane {
    background-color: #333333; /* 深色模式背景顏色 */
    color: #ffffff; /* 深色模式文字顏色 */
  }

  .right-pane {
    background-color: #1a1a1a; /* 深色模式背景顏色 */
    color: #ffffff; /* 深色模式文字顏色 */
  }
}
</style>
