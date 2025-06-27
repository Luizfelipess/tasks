<template>
  <li
    class="p-4 rounded-lg shadow-md border transition duration-200"
    :class="task.is_notified
      ? 'bg-green-50 border-green-400'
      : 'bg-white border-gray-200 hover:bg-gray-50'"
  >
    <div class="flex justify-between items-center mb-2">
      <h2 class="text-xl font-semibold text-gray-800">{{ task.title }}</h2>
      <span
        class="text-xs uppercase font-bold px-2 py-1 rounded"
        :class="task.is_notified ? 'bg-green-200 text-green-800' : 'bg-yellow-100 text-yellow-700'"
      >
        {{ task.is_notified ? 'Notificado' : 'Não Notificado' }}
      </span>
    </div>
    <p class="text-gray-700 mb-1">{{ task.description }}</p>
    <p class="text-sm text-gray-500">Agendada para: {{ formatDate(task.scheduled_to) }}</p>
  </li>
</template>

<script setup>
defineProps({
  task: {
    type: Object,
    required: true
  }
})

function formatDate(dateStr) {
  const date = new Date(dateStr)
  return date.toLocaleString('pt-BR', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}
</script>
