import axios from 'axios';

const API_URL = 'http://localhost:8000/api/projects';

export default {
  /**
   * Get list of projects
   * @returns {Promise}
   */
  getProjects() {
    return axios.get(API_URL);
  },

  /**
   * Get a single project by ID
   * @param {number} projectId
   * @returns {Promise}
   */
  getProject(projectId) {
    return axios.get(`${API_URL}/${projectId}`);
  },
};
