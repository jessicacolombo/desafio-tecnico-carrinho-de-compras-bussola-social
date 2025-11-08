import axios from 'axios'

const apiClient = axios.create({
  baseURL: import.meta.env.API_BASE_URL || 'http://localhost:8000/api',
  headers: { 'Content-Type': 'application/json' },
  timeout: 10000,
})

apiClient.interceptors.response.use(
  (res) => res,
  (error) => {
    const normalized = {
      status: error.response?.status,
      message: error.response?.data?.message || error.message,
    }
    return Promise.reject(normalized)
  },
)

export default apiClient
