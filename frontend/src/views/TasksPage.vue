<template>
  <div class="min-h-screen bg-gray-100 py-10 px-4">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-6">
      <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Lista de Tarefas</h1>

      <div v-if="tasks.length > 0" class="mb-4 flex justify-end items-center">
        <label for="perPage" class="mr-2 text-sm font-medium text-gray-700">Tarefas por página:</label>
        <select
            id="perPage"
            v-model="perPage"
            class="border border-gray-300 px-3 py-1 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          <option :value="5">5</option>
          <option :value="10">10</option>
          <option :value="20">20</option>
        </select>
      </div>

      <ul v-if="tasks.length > 0" class="space-y-4">
        <TaskItem
            v-for="task in tasks"
            :key="task.id"
            :task="task"
        />
      </ul>

      <TaskEmpty v-else-if="!loading && !error" />

      <div class="flex justify-center gap-4 mt-8" v-if="tasks.length > 0">
        <button
            @click="currentPage--"
            :disabled="currentPage <= 1"
            class="px-4 py-2 border rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          Anterior
        </button>

        <button
            @click="currentPage++"
            :disabled="currentPage >= totalPages"
            class="px-4 py-2 border rounded bg-gray-200 hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          Próxima
        </button>
      </div>

      <transition name="fade" mode="out-in">
        <TaskSpinner v-if="loading" class="mx-auto mt-8" />
      </transition>

      <transition name="fade" mode="out-in">
        <div v-if="error" class="text-center mt-8 text-red-600">Erro ao carregar tarefas.</div>
      </transition>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { fetchTasks } from '@/api/taskService'
import TaskItem from '@/components/TaskItem.vue'
import TaskSpinner from '@/components/TaskSpinner.vue'
import TaskEmpty from '@/components/TaskEmpty.vue'

const tasks = ref([])
const loading = ref(false)
const error = ref(false)
const currentPage = ref(1)
const perPage = ref(5)
const totalPages = ref(1)

async function loadTasks() {
  loading.value = true
  error.value = false
  try {
    const result = await fetchTasks(currentPage.value, perPage.value)

    tasks.value = result.data
    totalPages.value = result.last_page
  } catch (e) {
    error.value = true
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  document.title = 'Lista de Tarefas - Meu Projeto'
  loadTasks()
})

watch([currentPage, perPage], fetchTasks)
</script>
