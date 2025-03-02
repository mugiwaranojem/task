<script setup>
import TaskForm from "@/views/TaskForm.vue";
import { useRoute } from "vue-router";
const route = useRoute();
</script>

<template>
  <TaskForm :taskId="parseInt(route.params.id)"/>
</template>
