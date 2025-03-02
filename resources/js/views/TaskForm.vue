<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter, useRoute } from "vue-router";
import TaskService from "@/services/TaskService";
import ProjectService from "@/services/ProjectService";
import { format } from "date-fns";
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const props = defineProps({
  taskId: { type: [Number, null], default: null },
});

const action = ref('add');
if (props.taskId) {
  action.value = 'edit';
}

const route = useRoute();
const router = useRouter();

// Task form data
const task = ref({
  project_id: '',
  title: '',
  description: '',
  status: 'pending',
  deadline: null,
});
const message = ref(null);
const project = ref({id: null, title: ''});
const selectedDate = ref(null);
const loading = ref(false);
const projectId = ref(null);

const submitTask = async () => {
  loading.value = true;
  try {
    if (action.value === 'add') {
      task.value.project_id = route.params.projectId;
    }

    task.value.deadline = formatDate(selectedDate.value);

    if (action.value === 'add') {
      await TaskService.createTask(task.value);
    } else {
      await TaskService.updateTask(props.taskId, task.value);
    }
    
    message.value = action.value === 'add'
      ? 'Task created successfully!'
      : 'Task updated successfully!';
    loading.value = false;
    window.scrollTo({
      top: 0,
      behavior: "smooth", // Enables slow scrolling
    });
    
    // Redirect to task list after successful submission
    setTimeout(() => {
      router.push('/');
    }, 2000);
  } catch (error) {
    console.error('Error creating task:', error);
    message.value = 'Failed to create task.';
    loading.value = false;
  }
};

const formatDate = (date) => {
  return date ? format(date, "yyyy-MM-dd HH:mm:ss") : '';
};

// Fetch Project Details
const loadProject = async () => {
  try {
    const response = await ProjectService.getProject(route.params.projectId);
    project.value = response.data?.data;
  } catch (error) {
    console.error("Error fetching project:", error);
  }
};

// Fetch Project Details
const loadTask = async () => {
  try {
    const response = await TaskService.getTask(route.params.id);
    task.value = response.data?.data;
    selectedDate.value = task.value.deadline;
    project.value = task.value.project;
  } catch (error) {
    console.error("Error fetching task:", error);
  }
};

onMounted(async () => {
  if (action.value === 'edit') {
    await loadTask();
  } else {
    await loadProject();
  }
});
</script>

<template>
  <div class="container mt-4" style="max-width: 600px;">
    <h2 class="mb-3">
      <span v-if="action === 'add'">Add New Task</span>
      <span v-else>Edit Task</span>
    </h2>

    <div id="alert-message" v-if="message" class="alert alert-info">{{ message }}</div>

    <form @submit.prevent="submitTask">
      <!-- Project ID -->
      <div class="mb-3">
        <label class="form-label">Project</label>
        <input type="text" :value="project.title" class="form-control" disabled />
      </div>

      <!-- Title -->
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" v-model="task.title" class="form-control" required />
      </div>

      <!-- Description -->
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea v-model="task.description" class="form-control"></textarea>
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

      <!-- Deadline -->
      <div class="mb-3">
        <label class="form-label">Deadline</label>
        <Datepicker v-model="selectedDate" />
      </div>

      <button type="submit" class="btn btn-primary" :disabled="loading">
        <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
        {{ loading ? "Submitting..." : "Save" }}
      </button>
      <router-link to="/" class="btn btn-secondary ms-2">
        <i class="bi bi-arrow-left"></i> Back
      </router-link>
    </form>
  </div>
</template>
