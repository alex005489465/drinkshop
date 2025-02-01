<script setup lang="ts">
import { ref, onMounted, watch } from 'vue';

const titleRef = ref<HTMLElement | null>(null);

const adjustFontSize = () => {
  const titleElement = titleRef.value;
  if (!titleElement) return;

  let fontSize = 5; // 初始字體大小（rem）
  titleElement.style.fontSize = `${fontSize}rem`;

  while (titleElement.scrollWidth > titleElement.clientWidth && fontSize > 1) {
    fontSize -= 0.1;
    titleElement.style.fontSize = `${fontSize}rem`;
  }
};

onMounted(() => {
  adjustFontSize();
  window.addEventListener('resize', adjustFontSize);
});

watch(() => window.innerWidth, adjustFontSize);
</script>

<template>
  <div class="container mx-auto px-4 py-8">
    <h1 ref="titleRef" class="font-bold text-center responsive-title">
      歡迎來到 Bliss Paradise - 盡情享受飲料的樂園！
    </h1>
    <p class="mt-4">
      在 Bliss Paradise，我們致力於為您帶來無與倫比的飲料體驗。
      我們的每一杯飲品都融入了新鮮、天然的原料，精心調配，
      旨在為您提供最純正的味覺享受。無論是清新可口的果茶，
      還是香濃順滑的奶茶，亦或是充滿活力的特調飲料，
      這裡都能滿足您的所有期待。
    </p>
    <p class="mt-4">
      我們相信，飲料不僅僅是解渴的選擇，更是感受生活、
      享受每一刻的方式。Bliss Paradise 將帶給您如同置身天堂般的幸福感，
      讓每一口都充滿驚喜和快樂。
    </p>
    <p class="mt-4">
      來到 Bliss Paradise，一起探索飲品的無限可能，
      發現您的新寵。無論您是獨自前來，還是與朋友共享，
      我們都期待在這裡與您相遇。
    </p>
    <p class="mt-4">
      期待您的光臨，讓我們一起在 Bliss Paradise 尋找屬於您的快樂之飲。
    </p>
  </div>
</template>

<style scoped>
.container {
  max-width: 800px;
}

.responsive-title {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  display: inline-block;
  max-width: 100%;
}
</style>
