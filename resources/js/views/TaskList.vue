<script setup>
import { ref, onMounted } from 'vue';
import ProjectService from '@/services/ProjectService';
import TaskService from '@/services/TaskService';
import { useRouter } from 'vue-router';
import draggable from 'vuedraggable';

const projects = ref([]);
const selectedProjectId = ref(null);
const tasks = ref([]);
const router = useRouter();
const tests = ref([]);

// Load projects on mount
onMounted(async () => {
  try {
    const response = await ProjectService.getProjects();
    projects.value = response.data?.data;
  } catch (error) {
    console.error('Error fetching projects:', error);
  }
});

// Load tasks when project is selected
const loadTasks = async () => {
  if (!selectedProjectId.value) return;
  try {
    const response = await TaskService.getTasks(selectedProjectId.value);
    tasks.value = response.data?.data ?? [];
  } catch (error) {
    console.error('Error fetching tasks:', error);
  }
};

async function updateTaskOrder() {
  try {
    await TaskService.updateTaskOrder(tasks.value.map((task, index) => ({
      id: task.id,
      priority: index + 1, // Assigning new priority based on the order
    })));
    console.log("Task order updated successfully");
  } catch (error) {
    console.error('Error updating task order:', error);
  }
}

// Navigate to edit task page
const editTask = (taskId) => {
  router.push(`/tasks/${taskId}/edit`);
};
</script>

<template>
  <div class="container mt-4">
    <h2>Select a Project</h2>

    <!-- Project Dropdown -->
    <select v-model="selectedProjectId" @change="loadTasks" class="form-select">
      <option value="" disabled>Select a project</option>
      <option v-for="project in projects" :key="project.id" :value="project.id">
        {{ project.title }}
      </option>
    </select>

    <!-- Task List -->
    <div v-if="tasks.length > 0" class="mt-4">
      <h5>Task List</h5>
      <draggable
        v-model="tasks"
        @end="updateTaskOrder"
        item-key="id"
        tag="ul"
        class="list-group"
        :animation="200"
      >
      <!-- Draggable Task List -->
        <template v-slot:item="{ element }">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>{{ element.title }}</span><br />
            <div>
              <router-link :to="`/tasks/${element.id}/edit`" class="btn btn-warning btn-sm me-2">
                <i class="bi bi-pencil"></i>
              </router-link>
              <button @click="deleteTask(element.id)" class="btn btn-danger btn-sm">
                <i class="bi bi-trash"></i>
              </button>
            </div>

          </li>
        </template>
      </draggable>
    </div>

    <div v-else-if="selectedProjectId" class="mt-3">
      <p class="text-muted">No tasks found for this project.</p>
    </div>
  </div>
</template>

<style scoped>
.container {
  max-width: 600px;
  margin: auto;
}
.list-group-item {
  cursor: grab;
}
</style>
