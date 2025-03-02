<template>
  <div class="layout-container">
    <RouterView />
  </div>
</template>

<script setup>
import { RouterView } from 'vue-router';
</script>

<style scoped>
.layout-container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}
</style>
