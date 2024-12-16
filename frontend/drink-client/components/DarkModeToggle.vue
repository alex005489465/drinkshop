<script setup>
import { ref, watch } from 'vue';

const colorMode = useColorMode();

function toggleColorMode() {
  colorMode.preference = colorMode.preference === 'dark' ? 'light' : 'dark';
}

const buttonText = ref(colorMode.preference === 'dark' ? '明亮模式' : '深色模式');
watch(() => colorMode.preference, (newMode) => {
  buttonText.value = newMode === 'dark' ? '明亮模式' : '深色模式';
});

</script>

<template>
  <div>
    <!-- <h1>色彩模式: {{ $colorMode.value }}</h1> -->
    <button class="bg-transparent hover:bg-blue-500 font-semibold py-2 px-4 border
    border-blue-500 hover:border-transparent rounded" @click="toggleColorMode">
      {{ buttonText }}
    </button>
  </div>
</template>

<style>
body {
  background-color: #fff;
  color: rgba(0,0,0,0.8);
}
.dark-mode body {
  background-color: #091a28;
  color: #ebf4f1;
}
.sepia-mode body {
  background-color: #f1e7d0;
  color: #433422;
}
</style>
