import axios from 'axios'

export async function fetchTasks(page = 1, perPage = 5) {
  const response = await axios.get('/api/v1/tasks', {
    params: {
      page,
      per_page: perPage
    }
  })
  return response.data.data
}
