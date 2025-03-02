import axios from 'axios';

const API_URL = 'http://localhost:8000/api/tasks';

export default {
  /**
   * Get tasks by project ID
   * @param {number} projectId
   * @returns {Promise}
   */
  getTasks(projectId) {
    return axios.get(`http://localhost:8000/api/projects/${projectId}/tasks`);
  },

  /**
   * Get a single task by ID
   * @param {number} taskId
   * @returns {Promise}
   */
  getTask(taskId) {
    return axios.get(`${API_URL}/${taskId}`);
  },

  /**
   * Create a new task
   * @param {Object} taskData
   * @returns {Promise}
   */
  createTask(taskData) {
    return axios.post(API_URL, taskData);
  },

  /**
   * Update an existing task
   * @param {number} taskId
   * @param {Object} taskData
   * @returns {Promise}
   */
  updateTask(taskId, taskData) {
    return axios.put(`${API_URL}/${taskId}`, taskData);
  },

  /**
   * Delete a task by ID
   * @param {number} taskId
   * @returns {Promise}
   */
  deleteTask(taskId) {
    return axios.delete(`${API_URL}/${taskId}`);
  },

  /**
   *
   * @param {array} tasks
   * @returns {Promise}
   */
  updateTaskOrder(tasks) {
    return axios.post(`${API_URL}/update-order`, { tasks });
  },
};
