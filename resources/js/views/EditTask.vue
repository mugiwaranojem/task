<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import TaskService from "@/services/TaskService";

const route = useRoute();
const router = useRouter();
const task = ref({
  project_id: "",
  title: "",
  description: "",
  status: "pending",
  priority: 0,
  deadline: null,
});

onMounted(async () => {
  try {
    const response = await TaskService.getTask(route.params.id);
    task.value = response.data?.data;
  } catch (error) {
    console.error("Error fetching task:", error);
  }
});

const updateTask = async () => {
  try {
    await TaskService.updateTask(route.params.id, task.value);
    alert("Task updated successfully!");
    router.push("/");
  } catch (error) {
    console.error("Error updating task:", error);
  }
};
</script>

<template>
  <div class="container mt-4">
    <h2 class="text-center">Edit Task</h2>

    <form @submit.prevent="updateTask">
      <!-- Project ID -->
      <div class="mb-3">
        <label class="form-label">Project ID</label>
        <input v-model="task.project_id" type="number" class="form-control" disabled />
      </div>

      <!-- Title -->
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input v-model="task.title" type="text" class="form-control" required />
      </div>

      <!-- Description -->
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea v-model="task.description" class="form-control" rows="3"></textarea>
      </div>

      <!-- Status -->
      <div class="mb-3">
        <label class="form-label">Status</label>
        <select v-model="task.status" class="form-select">
          <option value="pending">Pending</option>
          <option value="in_progress">In Progress</option>
          <option value="completed">Completed</option>
        </select>
      </div>

      <!-- Priority -->
      <div class="mb-3">
        <label class="form-label">Priority</label>
        <input v-model="task.priority" type="number" class="form-control" min="0" max="5" />
      </div>

      <!-- Deadline -->
      <div class="mb-3">
        <label class="form-label">Deadline</label>
        <input v-model="task.deadline" type="datetime-local" class="form-control" />
      </div>

      <button type="submit" class="btn btn-success">
        <i class="bi bi-save"></i> Save Changes
      </button>
      <router-link to="/" class="btn btn-secondary ms-2">
        <i class="bi bi-arrow-left"></i> Back
      </router-link>
    </form>
  </div>
</template>
