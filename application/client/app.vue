<script setup lang="ts">
import { NavMain } from '#components';
</script>

<template>
  <div>
    <nav class="nav-main">
      <NavMain />
    </nav>
    <div class="content">
      <NuxtPage />
    </div>
  </div>
</template>

<style scoped>
.nav-main {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background-color: #2d3748; /* Tailwind CSS class bg-gray-800 */
  color: #ffffff; /* Tailwind CSS class text-white */
  padding: 16; /* Tailwind CSS class p-4 */
  z-index: 20; /* Tailwind CSS class z-50 */
}

.content {
  padding-top: 4rem; /* Tailwind CSS class pt-16 */
}
</style>
