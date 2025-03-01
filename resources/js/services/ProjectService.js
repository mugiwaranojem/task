import axios from 'axios';

const API_URL = 'http://localhost:8000/api/projects';

export default {
  getProjects() {
    return axios.get(API_URL);
  }
};