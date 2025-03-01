<template>
  <h1>Welcome Project Tasks</h1>
  <RouterView />
</template>

<script setup>
import ProjectTaskList from '@/components/ProjectTaskList.vue';
import { RouterView } from "vue-router";
</script>

<style scoped>
h1 {
  color: blue;
}
</style>